#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <sys/socket.h>
#include <arpa/inet.h>

#define RCVBUFSIZE 32
void DieWithError(char *errorMessage);

int main(int argc, char *argv[])
{
	int sock;
	struct sockaddr_in echoServAddr;
	unsigned short echoServPort;
	char *servlP;
	char *echoString;
	char echoBuffer[RCVBUFSIZE];
	unsigned int echoStringLen;
	int bytesRcvd, totalBytesRcvd;

if ((argc< 3) || (argc> 4))
{
   fprintf(stderr, "Usage: %s <Server IP> <Echo Word> [<Echo Port>]\n",
argv[0]);
exit(1);
 }
   
servlP = argv[1];
echoString = argv[2];

   if (argc == 4)
echoServPort = atoi(argv[3]); /* Use given port, if any */
else
echoServPort = 7; /* 7 is the well-known port for the echo service */
/* Create a reliable, stream socket using TCP */
if ((sock = socket(PF_INET, SOCK_STREAM, IPPROTO_TCP)) < 0)
DieWithError(" socket () failed");

memset(&echoServAddr, 0, sizeof(echoServAddr));

echoServAddr.sin_family= AF_INET;
echoServAddr.sin_addr.s_addr = inet_addr(servlP);
echoServAddr.sin_port= htons(echoServPort);
echoStringLen = strlen(echoString);
/* Send the string to the server */
if (send(sock, echoString, echoStringLen, 0) != echoStringLen)
DieWithError("send() sent a different number of bytes than expected");
/* Receive the same string back from the server */
totalBytesRcvd = 0;
printf("Received: ");
/* Setup to print the echoed string */
while (totalBytesRcvd < echoStringLen)
{
/* Receive up to the buffer size (minus i to leave space for
a null terminator) bytes from the sender */
if ((bytesRcvd = recv(sock, echoBuffer, RCVBUFSIZE - 1, 0)) <= 0)
DieWithError("recv() failed or connection closed prematurely");
totalBytesRcvd += bytesRcvd;
/* Keep tally of total bytes */
echoBuffer[bytesRcvd] = '\0'; /* Terminate the string! */
printf(echoBuffer);
}
/* Print the echo buffer */
   printf("\n");
   close(sock);
   exit(1);
}
