#include <sys/types.h>
#include <netinet/in.h>
#include <sys/socket.h>
#include <netdb.h>
#include <string.h>
#include <stdlib.h>
#include <stdio.h>
#include <unistd.h>
#include <time.h>
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
#define LINESIZE 1024
/* Function prototypes */
int getDataSocket(int *s);
int svcInitServer(int *s);
int sendMessage (int s, char *msg, int  msgSize);
int receiveMessage(int s, char *buffer, int  bufferSize, int *msgSize);
int dataConnect(char *servername, int *s);
/* List of all global variables */
char userCmd[1024];
char cmd[1024];
char name[1024];
char Sign[1024];
char nm[1024];
char agentsign[1024];
char sg[1024];
char id[1024];
char sgn[1024];
char arg[1024];
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
int svcInitServer (
	int *s
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
	svcAddr.sin_addr.s_addr=htonl(INADDR_ANY);
	svcAddr.sin_port=htons(SERVER_FTP_PORT);

	if(bind(sock,(struct sockaddr *)&svcAddr,sizeof(svcAddr))<0)
	{
		perror("cannot bind");
		close(sock);
		return(ER_BIND_FAILED);
	}

	qlen=1;

	listen(sock,qlen);

	*s=sock;

	return(OK);
}

int main(
	int argc,
	char *argv[]
	)
{
	int day, month, year;
	time_t now;
	time(&now);
	struct tm *local = localtime(&now);
	day = local->tm_mday;        	// get day of month (1 to 31)
	month = local->tm_mon + 1;   	// get month of year (0 to 11)
	year = local->tm_year + 1900;	// get year since 1900
	int msgSize;
	int listenSocket;
	int ccSocket;
	int status;

	printf("Started execution of server ftp\n");

	printf("Initialize ftp server\n");

	status=svcInitServer(&listenSocket);
	if(status != 0)
	{
		printf("Exiting server ftp due to svcInitServer returned error\n");
		exit(status);
	}


	printf("ftp server is waiting to accept connection\n");

	ccSocket = accept(listenSocket, NULL, NULL);

	//printf("Came out of accept() function \n");

	if(ccSocket < 0)
	{
		perror("cannot accept connection:");
		printf("Server ftp is terminating after closing listen socket.\n");
		close(listenSocket);
		return (ER_ACCEPT_FAILED);
	}

	//printf("Connected to client, calling receiveMsg to get ftp cmd from client \n");
	printf("Listening...\n");
	 printf("-----------------------------------------------------\n");
			 printf("           UNITED FRONT FOR TRANSFORMATION           \n");
			 printf("-----------------------------------------------------\n");
			 printf("Date: %02d/%02d/%d\n", day, month, year);



			  status=receiveMessage(ccSocket, name, sizeof(name), &msgSize);
				strcpy(nm,name);
				//printf("%s\n",n );
				status=receiveMessage(ccSocket, Sign, sizeof(Sign), &msgSize);
				strcpy(sgn,Sign);
				//printf("%s\n",sg );
				char s[16];
				char m;
				char ss[50];
				int n;
				int i = 0;
				int sign[10][10];
				strcpy(s, strtok(sgn, "\n"));
				strcpy(ss, strtok(s, "\n"));
					for(int x=1;x<6;x++){
							for(int j=1;j<4;j++){

									m = *(s+i);
									n = m - '0';

									sign[x][j] = n;
									//printf("\nCell(%d,%d)-%d\n",x,j,sign[x][j]);
									//scanf("%d",&sign[x][j]);
									i++;
							}
					}
					for(int x=1;x<6;x++){
							for(int j=1;j<4;j++){
									if(sign[x][j] == 0){
											printf(" ");
									}
									else {
											printf("*");
									}
							}
							printf("\n");
					}

				 if(strcmp(ss, "110101110101110") == 0){
					 strcpy(sg,"B");
					 printf("your signature is: B\n");
				 }else if(strcmp(ss, "010000111101101") ==0){
					  strcpy(sg,"A");
					 printf("your signature is: A\n");
				 }else if(strcmp(ss, "110101101101110") ==0){
					  strcpy(sg,"D");
					 printf("your signature is: D\n");
				 }else if(strcmp(ss, "111100110100111") ==0){
					  strcpy(sg,"E");
					 printf("your signature is: E\n");
				 }else if(strcmp(ss, "111100110100100") ==0){
					  strcpy(sg,"F");
					 printf("your signature is: F\n");
				 }else if(strcmp(ss, "111100100101111") ==0){
					  strcpy(sg,"G");
					 printf("your signature is: G\n");
				 }else if(strcmp(ss, "101101111101101") ==0){
					  strcpy(sg,"H");
					 printf("your signature is: H\n");
				 }else if(strcmp(ss, "111010010010111") ==0){
					  strcpy(sg,"I");
					 printf("your signature is: I\n");
				 }else if(strcmp(ss, "011001001101010") ==0){
					  strcpy(sg,"J");
					 printf("your signature is: J\n");
				 }else if(strcmp(ss, "100100100100111") ==0){
					  strcpy(sg,"L");
					 printf("your signature is: L\n");
				 }else if(strcmp(ss, "010101101101010") ==0){
					  strcpy(sg,"O");
					 printf("your signature is: O\n");
				 }else if(strcmp(ss, "110101110100100") ==0){
					  strcpy(sg,"P");
					 printf("your signature is: P\n");
				 }else if(strcmp(ss, "011100010001110") ==0){
					  strcpy(sg,"S");
					 printf("your signature is: S\n");
				 }else if(strcmp(ss, "111010010010010") ==0){
					 strcpy(sg,"T");
					 printf("your signature is: T\n");
				 }else if(strcmp(ss, "101101101101010") ==0){
					 strcpy(sg,"U");
					 printf("your signature is: U\n");
				 }else if(strcmp(ss, "111000010000111") ==0){
					 strcpy(sg,"Z");
					 printf("your signature is: Z\n");
				 }else if(strcmp(ss, "101101111001111") ==0){
					 strcpy(sg,"Y");
					 printf("your signature is: Y\n");
				 }


				FILE *myfile;
 			 char line[LINESIZE];
 			 char name1[1024];
			 char sign1[1024];
			 char Id[1024];
			 int f;
 			 myfile = fopen ("agent.txt", "r" );
 			 while(fgets(line, sizeof(line), myfile)){

 			  // value = strtok(line, "\n");
 			   sscanf(line,"%s %s %s", name1,sign1,Id);
 			  // printf("%s ",name1);
 			   //printf("%s\n",sign1);
 			   if((strcmp(name1, (strtok(nm, "\n"))) ==0) && (strcmp(sign1, (strtok(sg, "\n"))) ==0)){
 			     printf("Welcome agent %s\n", name1);
					 strcpy(id,Id);
					 strcpy(agentsign,sign1);
					f++;
 			   }
 			 }
			 if(f>0){
				  strcpy(replyMsg,"Welcome");
			 }else{
				  strcpy(replyMsg,"wrong info");
			 }
			  status=sendMessage(ccSocket,replyMsg,strlen(replyMsg) + 1);

			 //fclose(myfile);

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
				strcpy(argument, strtok(NULL, "\n"));
				//strcpy(arg, strtok(NULL, " "));


      }
      strcpy(users,  "reagan mujambere\n"
                     "simbwa christopher\n"
                     "katamba james\n"
                     "nkanji joel\n");

	 if(strcmp(cmd, "user")==0) {
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
    if( found==0 )
		{
			sprintf(replyMsg, "cmd 332 that user doesn't exist, like Santa or George Washington.\n");
		 }
  }
  else if(strcmp(cmd, "help")==0) {
               printf("Commands\t\t Use \t\t\t\t\t Syntax\n"
                      "Help \t\t this help menu    \t\t\t help ;\n"
                      "user \t\t log in as user    \t\t\t username user ;\n"
                      "quit \t\t log out of system \t\t\t quit ;\n"
                      "Addmember \t add a new member \t\t\t Addmember <name> <date> <gender> <recommender> \n"
                      "Getstatement\t view financial statement \t\t Get Statement ;\n"
                      "Addmemberfile\t add a file with member information \t Addmemberfile <file.txt> \n"
                      "Check status\t checking status \t\t\t Checkstatus ;\n"
										 );
  }
  else if(strcmp(cmd, "logout")==0) {
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
			else if(strcmp("Addmember", cmd)==0) {
				FILE *fd;
				fd = fopen("memberx.txt", "a");
				    fprintf(fd, "%s,%s,%s\n",argument,agentsign,id);//(argument,sizeof(argument),1,fd);
					  printf("member has been registerd\n");
					  fclose(fd);
				}
				else if(strcmp("Addmemberfile", cmd)==0) {
					FILE *myfile = fopen ( argument, "r" );
			    char line[LINESIZE];
			    char *value;
			    while(fgets(line, sizeof(line), myfile)){
			        value = strtok(line, "\n");
			    if(value != NULL)
					{
						FILE *fp;
						fp = fopen ("memberx.txt", "a");
						fprintf(fp, "%s\n",value);//(value,sizeof(value),1,fp);
						fclose(fp);
					}

			}
			    printf("\nfile has been added......\n");
			    fclose(myfile);
					}
					else if(strcmp("Check", cmd)==0) {

						FILE *myfile = fopen ("memberx.txt", "r" );
					  char line[LINESIZE];
					  char c;
					  int i;
					  int words = 0;
					  int members = 0;
					   while(fgets(line, sizeof(line), myfile))
					   {

					    members++;

					   }

					  printf("there are %d members\n",members);
					  fclose(myfile);
						FILE *myfile1 = fopen ("error.txt", "r" );
					  char line1[LINESIZE];
					  int members1 = 0;
					   while(fgets(line, sizeof(line), myfile))
					   {

					    members1++;

					   }

					  printf("there are %d invalid entries\n",members1);
					  fclose(myfile1);
					}else {
    sprintf(replyMsg, "cmd 202 that is not a valid command\n");
  }

	    status=sendMessage(ccSocket,replyMsg,strlen(replyMsg) + 1);
				  if(status < 0)
	    {
		break;  /* exit while loop */
	    }
	}
	while(strcmp(cmd, "logout") != 0);

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
		return(ER_BIND_FAILED);	/* bind failed */
	}

 	qlen=1;


	listen(sock,qlen);
	*s=sock;

	return(OK);
}
