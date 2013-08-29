#include <stdio.h>
#include <sys/types.h>
#include <stdlib.h>
#include <string.h>
#include <sys/socket.h> 
#include <netinet/in.h>
#include <arpa/inet.h>

/* THE SERVER PROCESS */

/* Compile this program with cc server.c -o server
and then execute it as ./server &
*/

main()
{
	int			sockfd, newsockfd ; /* Socket descriptors */
	int			clilen;
	struct sockaddr_in	cli_addr, serv_addr;
       	int recvdbytes;
	int i;
	char buf[200];		/* We will use this buffer for communication */
	char cmd1[500];
	char wfile[50];
	/* The following system call opens a socket. The first parameter
	indicates the family of the protocol to be followed. For internet
	protocols we use AF_INET. For TCP sockets the second parameter
	is SOCK_STREAM. The third parameter is set to 0 for user
	applications.
	*/
	if ((sockfd = socket(AF_INET, SOCK_STREAM, 0)) < 0) {
		printf("Cannot create socket\n");
		exit(0);
	}
	
	
	/* The structure "sockaddr_in" is defined in <netinet/in.h> for the
	internet family of protocols. This has three main fields. The
	field "sin_family" specifies the family and is therefore AF_INET
	for the internet family. The field "sin_addr" specifies the
	internet address of the server. This field is set to INADDR_ANY
	for machines having a single IP address. The field "sin_port"
	specifies the port number of the server.
	*/
	serv_addr.sin_family		= AF_INET;
	serv_addr.sin_addr.s_addr	= INADDR_ANY;
	serv_addr.sin_port		= htons(5432);  // port number
	
	/* With the information provided in serv_addr, we associate the server
	with its port using the bind() system call. 
	*/
	if (bind(sockfd, (struct sockaddr *) &serv_addr,
		sizeof(serv_addr)) < 0) {
	printf("Unable to bind local address\n");
	exit(0);
		}
		
		listen(sockfd, 10); /* This specifies that up to 10 concurrent client
		requests will be queued up while the system is
		executing the "accept" system call below.
		*/
		
		/* In this program we are illustrating a concurrent server -- one
		which forks to accept multiple client connections concurrently.
		As soon as the server accepts a connection from a client, it
		forks a child which communicates with the client, while the
		parent becomes free to accept a new connection. To facilitate
		this, the accept() system call returns a new socket descriptor
		which can be used by the child. The parent continues with the
		original socket descriptor.
		*/
		while (1) {
			
			/* The accept() system call accepts a client connection.
			It blocks the server until a client request comes.
			
			The accept() system call fills up the client's details
			in a struct sockaddr which is passed as a parameter.
			The length of the structure is noted in clilen. Note
			that the new socket descriptor returned by the accept()
			system call is stored in "newsockfd".
			*/
			clilen = sizeof(cli_addr);
			newsockfd = accept(sockfd, (struct sockaddr *) &cli_addr, &clilen) ;
			
			printf("welcome again");
			if (newsockfd < 0) 
			{
				printf("Accept error\n");
				exit(0);
			}
			else
			{
				printf("GOT THE MESSAGE\n");
				char str[1000];
				char *out_file;
				char tmp[100], msg[100];
				for(i=0;i<200;i++) buf[i]='\0';
				for(i=0;i<500;i++) cmd1[i]='\0';
				recvdbytes = recv(newsockfd, buf, sizeof(buf), 0);
				printf("got data from mycallserver.php\n");
				printf("%s\n",buf);
				if(strcmp(buf,"execute")==0){
					strcat(cmd1,"./myexecute.sh");
					strcat(cmd1," &");
				}
				else if(strcmp(buf,"delete")==0){
					strcat(cmd1,"./myexecute2.sh");
					//strcat(cmd1," &");
				}
				puts(cmd1);
				printf("========COMMAND STARTS HERE========%s\n=========COMMAND ENDS HERE===============",cmd1);
				system(cmd1);
				printf("SCRIPT EXECUTED!");
				strcpy(msg,"Command Executed");
				send(newsockfd,msg,16,0);
			}
			
			close(newsockfd);
		}
		
}
