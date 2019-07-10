#include <sys/types.h>
#include <netinet/in.h>
#include <sys/socket.h>
#include <netdb.h>
#include <string.h>
#include <stdlib.h>
#include <stdio.h>
#include <unistd.h>
#define SERVER_FTP_PORT 1231
#define DATA_CONNECTION_PORT SERVER_FTP_PORT +1
/* Error and OK codes */
#define OK 0
#define ER_INVALID_HOST_NAME -1
#define ER_CREATE_SOCKET_FAILED -2
#define ER_BIND_FAILED -3
#define ER_CONNECT_FAILED -4
#define ER_SEND_FAILED -5
#define ER_RECEIVE_FAILED -6
#define ER_ACCEPT_FAILED -7
/* Function prototypes */
int getDataSocket(int *s);
int svcInitServer(int *s);
int sendMessage (int s, char *msg, int  msgSize);
int receiveMessage(int s, char *buffer, int  bufferSize, int *msgSize);
int dataConnect(char *servername, int *s);
/* List of all global variables */
char userCmd[1024];
char cmd[1024];
char argument[1024];
char replyMsg[4096];
char *space=" ";
char buffer[4096];
FILE *myfile;
char users[1024];
char user[1024];
char pass[1024];


int dataConnect (
	char *serverName,
	int *s
	)
{
	int sock;

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
		return(ER_CONNECT_FAILED);  	/* error return */
	}

	*s=sock;

	return(OK); /* successful return */
}
int svcInitServer (
	int *s 		/*Listen socket number returned from this function */
	)
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
	svcAddr.sin_addr.s_addr=htonl(INADDR_ANY);  /* server IP address */
	svcAddr.sin_port=htons(SERVER_FTP_PORT);    /* server listen port # */

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

int main(
	int argc,
	char *argv[]
	)
{

	int msgSize;        /* Size of msg received in octets (bytes) */
	int listenSocket;   /* listening server ftp socket for client connect request */
	int ccSocket;        /* Control connection socket - to be used in all client communication */
	int status;

	printf("Started execution of server ftp\n");

	printf("Initialize ftp server\n");	/* changed text */

	status=svcInitServer(&listenSocket);
	if(status != 0)
	{
		printf("Exiting server ftp due to svcInitServer returned error\n");
		exit(status);
	}


	printf("ftp server is waiting to accept connection\n");

	/* wait until connection request comes from client ftp */
	ccSocket = accept(listenSocket, NULL, NULL);

	printf("Came out of accept() function \n");

	if(ccSocket < 0)
	{
		perror("cannot accept connection:");
		printf("Server ftp is terminating after closing listen socket.\n");
		close(listenSocket);  /* close listen socket */
		return (ER_ACCEPT_FAILED);  // error exist
	}

	printf("Connected to client, calling receiveMsg to get ftp cmd from client \n");

	do
	{
 	    status=receiveMessage(ccSocket, userCmd, sizeof(userCmd), &msgSize);
			    if(status < 0)
	    {
		      printf("Receive message failed. Closing control connection \n");
		      printf("Server ftp is terminating.\n");
		      break;
	    }
      if(strchr(userCmd,' ')==NULL)
      strcpy(cmd,userCmd);
      else {
	      strcpy(cmd, strtok(userCmd, space));
	      strcpy(argument, strtok(NULL, space));

      }
      strcpy(users, "alex password\n"
                     "Peter derp\n"
                     "Freya beauty\n"
                     "AdamJensen INeverAskedForThis\n");

	if(strcmp(cmd, "pwd")==0) {
    memset(buffer,'\0',sizeof(buffer));
		system("pwd > /tmp/pwd.txt");
		myfile=fopen("/tmp/pwd.txt","r");
		status = fread(buffer, sizeof(buffer), sizeof(char), myfile);
		sprintf(replyMsg, "cmd 250 okay %s\n", buffer);
    fclose(myfile);
		system("rm /tmp/pwd.txt");
	}
  else if(strcmp(cmd, "ls")==0) {
    memset(buffer,'\0',sizeof(buffer));
		system("ls > /tmp/ls.txt");
		myfile=fopen("/tmp/ls.txt","r");
	  status = fread(buffer, sizeof(buffer), sizeof(char), myfile);
    sprintf(replyMsg, "cmd 250 okay \n%s\n",buffer);
    fclose(myfile);
    system("rm /tmp/ls.txt");
  }
  else if(strcmp(cmd, "mkdir")==0) {
    memset(buffer,'\0',sizeof(buffer));
    if(strlen(argument)==0) {
      printf("no argument supplied. Please retry with argument");
      memset(cmd,'\0',sizeof(cmd));
      memset(argument,'\0',sizeof(argument));
    }
    char subcommand[1024];
    memset(replyMsg,'\0',sizeof(replyMsg));
    sprintf(subcommand, "mkdir %s", argument);
    status= system(subcommand);
    sprintf(replyMsg, "cmd 212 successfully created dir %s\n", argument);
    memset(cmd,'\0',sizeof(cmd));
    memset(argument, '\0',sizeof(cmd));
  }
  else if(strcmp(cmd, "rmdir")==0) {
    char subcommand[1024];
    memset(replyMsg,'\0', sizeof(replyMsg));
    if(strlen(argument)==0) {
      sprintf(replyMsg, "no argument supplied. rmdir requires an argument\n");
    }
    sprintf(subcommand, "rmdir %s", argument);
    status=system(subcommand);
    if(status < 0) {
      sprintf(replyMsg, "error; try again.\n");
    }
    sprintf(replyMsg, "cmd 212 successfully removed %s\n", argument);
    memset(cmd,'\0',sizeof(cmd));
    memset(argument,'\0',sizeof(argument));
  }
  else if(strcmp(cmd, "dele")==0) {
    char subcommand[1024];
    memset(replyMsg, '\0', sizeof(replyMsg));
    if(strlen(argument)==0) {
      sprintf(replyMsg, "error; no argument supplied\n");
    }
    sprintf(subcommand,"rm %s", argument);
    status=system(subcommand);
    if( status < 0 ) {
      sprintf(replyMsg, "error occured\n");
    }
    sprintf(replyMsg, "cmd 211 okay, deleted %s\n", argument);
    memset(cmd,'\0',sizeof(cmd));
    memset(argument, '\0',sizeof(argument));
  }
  else if(strcmp(cmd, "cd")==0) {
    memset(replyMsg, '\0', sizeof(replyMsg));
    status= chdir(argument);
    if(status < 0) {
      sprintf(replyMsg, "that directory does not exist\n");
    }
    memset(cmd,'\0',sizeof(cmd));
    memset(argument, '\0', sizeof(argument));
    /* in order to move backwards in a directory */
    }

  else if(strcmp(cmd, "stat")==0) {
    memset(replyMsg, '\0', sizeof(replyMsg));
    memset(buffer,'\0',sizeof(buffer));
    if(strlen(argument)>0) {
      printf("there is no need for arguments with this command");
    }
    system("stat > /tmp/stat.txt");
    myfile=fopen("/tmp/stat.txt", "r");
    fread(buffer, sizeof(buffer), sizeof(char), myfile);
    strcpy(replyMsg, buffer);
    fclose(myfile);
    system("rm /tmp/stat.txt");
  }
  else if(strcmp(cmd, "user")==0) {
    char line[1024];
    char * theline;
    int found=0;
    strcpy (line, users);
    theline= strtok(line, "\n");
    do {
    //  printf("line: %s\n", theline);
      sscanf(theline, "%s %s", user, pass);
      if(strcmp(argument, user)==0) {
        strcpy(replyMsg, "cmd 331 name okay, need password \n");
        found=1;
        break;
      }
      theline= strtok(NULL, "\n");
      memset(replyMsg, '\0', sizeof(replyMsg));
    } while ( theline!=NULL );
    if( found==0 ){ sprintf(replyMsg, "cmd 332 that user doesn't exist, like Santa or George Washington.\n"); }
  }
  else if(strcmp(cmd, "help")==0) {
    strcpy(replyMsg, "Commands\t\t Use \t\t\t Syntax\n"
                      "Help \t\t this help menu    \t help ;\n"
                      "cd   \t\t change directory  \t cd dir ;\n"
                      "dele \t\t remove a file     \t dele file ;\n"
                      "stat \t\t print stats       \t stat ;\n"
                      "mkdir\t\t make a directory  \t mkdir dir ;\n"
                      "rmdir\t\t remove directory  \t rmdir dir ;\n"
                      "ls   \t\t print files in dir\t ls ;\n"
                      "pass \t\t log in password   \t password pass ;\n"
                      "user \t\t log in as user    \t username user ;\n"
                      "quit \t\t log out of system \t logout ;\n"
                      "Addmember \t add a new member \t Addmember <name> <date> <gender> <recommender> ;\n"
                      "Get Statement\t view financial statement \t Get Statement ;\n"
                      "Addmemberfile\t add a file with member information \t Addmemberfile <file.txt> ;\n"
                      "Checkstatus\t checking status \t Checkstatus ;\n"
                      );
  }
  else if(strcmp(cmd, "pass")==0) {
    memset(replyMsg, '\0', sizeof(replyMsg));
    if(pass[0]=='\0') sprintf(replyMsg, "cmd 332 need account for login\n");
    if(strcmp(argument, pass)==0) sprintf(replyMsg, "cmd 231 password correct");
    else sprintf(replyMsg, "password incorrect");
  }
  else if(strcmp(cmd, "quit")==0) {
    memset(replyMsg, '\0', sizeof(replyMsg));
    strcpy(replyMsg, "cmd 231 okay, user logged out\n");
  } else if(strcmp("recv", cmd)==0) {
        FILE *afile;
        char buff[201];
        int numberoffrigginbytes=0;
        int data_socket;
        status = getDataSocket(&data_socket);
        if(status!=OK) printf("no");
        data_socket=accept(data_socket, NULL, NULL);
        afile=fopen(argument, "r");
        if(afile!=NULL) {
          while(!feof(afile)) {
            numberoffrigginbytes=fread(buff, sizeof(char), 200, afile);
            status = sendMessage(data_socket, buff, strlen(buff)+1);
            if(status!=OK) break;
          }
          memset(buff, '\0', sizeof(buff));
          fclose(afile);
          close(data_socket);
        }
      }
      else if(strcmp("put", cmd)==0) {
        char buff[201];
        int s;
        dataConnect("127.0.0.1", &s);
        s=accept(s, NULL, NULL);
        FILE *newfile=fopen("newfile", "w");
        while(1) {
          if(msgSize==0) break;
          status=receiveMessage(s,buff,sizeof(buff), &msgSize);
          fwrite(buff, sizeof(char), msgSize, newfile);
          fflush(newfile);
        }
        fclose(newfile);
        close(s);
  } else {
    sprintf(replyMsg, "cmd 202 that is not a valid command\n");
  }

	    status=sendMessage(ccSocket,replyMsg,strlen(replyMsg) + 1);
				  if(status < 0)
	    {
		break;  /* exit while loop */
	    }
	}
	while(strcmp(cmd, "quit") != 0);

	printf("Closing control connection socket.\n");
	close (ccSocket);

	printf("Closing listen socket.\n");
	close(listenSocket);  /*close listen socket */

	printf("Existing from server ftp main \n");

	return (status);
}

int sendMessage(
	int    s,
	char   *msg, 	/* buffer having the message data */
	int    msgSize 	/* size of the message/data in bytes */
	)
{
	if((send(s, msg, msgSize, 0)) < 0)
	{
		perror("unable to send ");
		return(ER_SEND_FAILED);
	}

	return(OK);
}

int receiveMessage (
	int s,
	char *buffer,
	int bufferSize,
	int *msgSize
	)
{
	int i;

	*msgSize=recv(s,buffer,bufferSize,0);

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
	svcAddr.sin_port=htons(DATA_CONNECTION_PORT+1);
if(bind(sock,(struct sockaddr *)&svcAddr,sizeof(svcAddr))<0)
	{
		perror("cannot bind");
		close(sock);
		return(ER_BIND_FAILED);
	}
  qlen=1;

	listen(sock,qlen
	*s=sock;

	return(OK
}
