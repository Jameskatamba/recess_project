#include<stdio.h>
#include<sys/socket.h>
#include<arpa/inet.h>
#include<stdlib.h>
#include<string.h>
#include<unistd.h>
#define MAXPENDING 5

printf() and fprintf() 
socket(), bind(), connect(), recv() and send() 
sockaddr_in and inet_ntoa() 
atoi() and exit() memset() 
close()

void DieWithError(char *errorMessage);
void HandleTCPClient(int clntSocket); 

int main(int argc, char *argv[]) {
int servSock;
int clntSock;
struct sockaddr_in echoServAddr;
struct sockaddr_in echoClntAddr;
unsigned short echoServPort;
unsigned int clntLen;if (argc != 2) {

fprintf(stderr, "Usage: %s <Server Port>\n", argv[0]);
exit(1);
}
echoServPort = atoi(argv[1]);

if ((servSock = socket(PF_INET, SOCK_STREAM, IPPROTO_TCP)) < 0)
DieWithError("socket() failed");

