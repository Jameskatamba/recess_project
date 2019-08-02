#include <sys/types.h>
#include <netinet/in.h>
#include <sys/socket.h>
#include <netdb.h>
#include <string.h>
#include <stdio.h>
#include <unistd.h>
#include <netdb.h>
#include <stdlib.h>

#define SERVER_FTP_PORT 1231
#define DATA_CONNECTION_PORT SERVER_FTP_PORT +1

#define OK 0
#define ER_INVALID_HOST_NAME -1
#define ER_CREATE_SOCKET_FAILED -2
#define ER_BIND_FAILED -3
#define ER_CONNECT_FAILED -4
#define ER_SEND_FAILED -5
#define ER_RECEIVE_FAILED -6


/* Function prototypes */
int dataConnect(char *serverName, int *s);
int clntConnect(char	*serverName, int *s);
int sendMessage (int s, char *msg, int  msgSize);
int receiveMessage(int s, char *buffer, int  bufferSize, int *msgSize);
int getDataSocket(int *s);

/* List of all global variables */

char userCmd[1024];
char name[1024];
char Sign[1024];
char cmd[1024];
char argument[1024];
char replyMsg[4096];
char *space = " ";


int main(	int argc,	char *argv[]){
	/* List of local varibale */

	int ccSocket;
	int msgSize;
	int status = OK;

	printf("Started execution of client ftp\n");
	 /* Connect to client ftp*/
	printf("Calling clntConnect to connect to the server\n");
	status=clntConnect("127.0.0.1", &ccSocket);
	if(status != 0)
	{
		printf("Connection to server failed, exiting main. \n");
		return (status);
	}
	printf("enter name :");
	fgets(name, sizeof(name), stdin);
	status = sendMessage(ccSocket, name, strlen(name)+1);
	printf("signature :");
	fgets(Sign, sizeof(Sign), stdin);
	status = sendMessage(ccSocket, Sign, strlen(Sign)+1);

	status = receiveMessage(ccSocket, replyMsg, sizeof(replyMsg), &msgSize);
	if(strcmp(replyMsg, "wrong info") ==0){
		printf("please run the program again and provide right information\n");
	}else{
	do
	{
		printf("-:");
		fgets(userCmd, sizeof(userCmd), stdin);
		status = sendMessage(ccSocket, userCmd, strlen(userCmd)+1);
		if(status != OK)
		{
		    break;
		}

		

	}
	while (strcmp(userCmd, "logout") != 0);

	printf("Closing control connection \n");
	close(ccSocket);  /* close control connection socket */

	printf("Exiting client main \n");

	return (status);
  }
}

int dataConnect (
	char *serverName,
	int *s
	)
{
	int sock;

	struct sockaddr_in clientAddress;
	struct sockaddr_in serverAddress;
	struct hostent	   *serverIPstructure;

	if((serverIPstructure = gethostbyname(serverName)) == NULL)
	{
		printf("%s is unknown server. \n", serverName);
		return (ER_INVALID_HOST_NAME);
	}

	if((sock = socket(AF_INET, SOCK_STREAM, 0)) < 0)
	{
		perror("cannot create socket ");
		return (ER_CREATE_SOCKET_FAILED);
	}

	memset((char *) &clientAddress, 0, sizeof(clientAddress));

	clientAddress.sin_family = AF_INET;
	clientAddress.sin_addr.s_addr = htonl(INADDR_ANY);
	clientAddress.sin_port = 0;

	if(bind(sock,(struct sockaddr *)&clientAddress,sizeof(clientAddress))<0)
	{
		perror("cannot bind");
		close(sock);
		return(ER_BIND_FAILED);
	}

	memset((char *) &serverAddress, 0, sizeof(serverAddress));

	serverAddress.sin_family = AF_INET;
	memcpy((char *) &serverAddress.sin_addr, serverIPstructure->h_addr,
			serverIPstructure->h_length);
	serverAddress.sin_port = htons(DATA_CONNECTION_PORT);

	if (connect(sock, (struct sockaddr *) &serverAddress, sizeof(serverAddress)) < 0)
	{
		perror("Cannot connect to server ");
		close (sock);
		return(ER_CONNECT_FAILED);
	}


	*s=sock;

	return(OK);
}

int clntConnect (
	char *serverName, /* server IP address in dot notation (input) */
	int *s 		  /* control connection socket number (output) */
	)
{
	int sock;	/* local variable to keep socket number */

	struct sockaddr_in clientAddress;  	/* local client IP address */
	struct sockaddr_in serverAddress;	/* server IP address */
	struct hostent	   *serverIPstructure;	/* host entry having server IP address in binary */

	if((serverIPstructure = gethostbyname(serverName)) == NULL)
	{
		printf("%s is unknown server. \n", serverName);
		return (ER_INVALID_HOST_NAME);  /* error return */
	}

	if((sock = socket(AF_INET, SOCK_STREAM, 0)) < 0)
	{
		perror("cannot create socket ");
		return (ER_CREATE_SOCKET_FAILED);	/* error return */
	}

	memset((char *) &clientAddress, 0, sizeof(clientAddress));


	clientAddress.sin_family = AF_INET;	/* Internet protocol family */
	clientAddress.sin_addr.s_addr = htonl(INADDR_ANY);  /* INADDR_ANY is 0, which means */
	clientAddress.sin_port = 0;  /* With port set to 0, system will allocate a free port */

	if(bind(sock,(struct sockaddr *)&clientAddress,sizeof(clientAddress))<0)
	{
		perror("cannot bind");
		close(sock);
		return(ER_BIND_FAILED);	/* bind failed */
	}


	memset((char *) &serverAddress, 0, sizeof(serverAddress));
	serverAddress.sin_family = AF_INET;
	memcpy((char *) &serverAddress.sin_addr, serverIPstructure->h_addr,
			serverIPstructure->h_length);
	serverAddress.sin_port = htons(SERVER_FTP_PORT);

	if (connect(sock, (struct sockaddr *) &serverAddress, sizeof(serverAddress)) < 0)
	{
		perror("Cannot connect to server ");
		close (sock); 	/* close the control connection socket */
		return(ER_CONNECT_FAILED);  	/* error return */
	}

	*s=sock;

	return(OK); /* successful return */
}


int sendMessage(
	int s, 		/* socket to be used to send msg to client */
	char *msg, 	/*buffer having the message data */
	int msgSize 	/*size of the message/data in bytes */
	)
{


	if((send(s,msg,msgSize,0)) < 0) /* socket interface call to transmit */
	{
		perror("unable to send ");
		return(ER_SEND_FAILED);
	}

	return(OK); /* successful send */
}


int receiveMessage (
	int s, 		/* socket */
	char *buffer, 	/* buffer to store received msg */
	int bufferSize, /* how large the buffer is in octet */
	int *msgSize 	/* size of the received msg in octet */
	)
{
	int i;

	*msgSize=recv(s,buffer,bufferSize,0); /* socket interface call to receive msg */

	if(*msgSize<0)
	{
		perror("unable to receive");
		return(ER_RECEIVE_FAILED);
	}

	for(i=0;i<*msgSize;i++)
	{
		printf("%c", buffer[i]);
	}
	printf("\n");

	return (OK);
}



int clntExtractReplyCode (
	char	*buffer,    /* Pointer to an array containing the reply message (input) */
	int	*replyCode  /* reply code (output) */
	)
{
	/* extract the codefrom the server reply message */
   sscanf(buffer, "%d", replyCode);

   return (OK);
}  // end of clntExtractReplyCode()

int getDataSocket (int *s)
{
  int sock;
	struct sockaddr_in svcAddr;
	int qlen;

	if( (sock=socket(AF_INET, SOCK_STREAM,0)) <0)
	{
		perror("cannot create socket");
		return(ER_CREATE_SOCKET_FAILED);
	}

	memset((char *)&svcAddr,0, sizeof(svcAddr));
	svcAddr.sin_family = AF_INET;
	svcAddr.sin_addr.s_addr=htonl(INADDR_ANY);
	svcAddr.sin_port=htons(DATA_CONNECTION_PORT);

	if(bind(sock,(struct sockaddr *)&svcAddr,sizeof(svcAddr))<0)
	{
		perror("cannot bind");
		close(sock);
		return(ER_BIND_FAILED);	/* bind failed */
	}

	qlen=1;

	listen(sock,qlen);  /* socket interface function call */

	*s=sock;

	return(OK); /*successful return */
}
