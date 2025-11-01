#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#include<unistd.h>
#include<sys/types.h>
#include<sys/socket.h>
#include<netinet/in.h>
#include<arpa/inet.h>
#include<pthread.h>

#define PORT 1234
#define BACKLOG 5
#define MAXDATASIZE 1000

void process_cli(int connfd,struct sockaddr_in client);
void* function(void* arg);
struct ARG
{
	int connfd;
	struct sockaddr_in client;
};

int main()
{
	int listenfd,connfd;
	pthread_t tid;
	struct ARG *arg;
	struct sockaddr_in server;
	struct sockaddr_in client;
	socklen_t len;
	if ((listenfd = socket(AF_INET,SOCK_STREAM,0)) == -1)
	{
		perror("socket() error.\n");
		exit(1);
	}
	int opt = SO_REUSEADDR;
	setsockopt(listenfd,SOL_SOCKET,SO_REUSEADDR,&opt,sizeof(opt));
	bzero(&server,sizeof(server));
	server.sin_family = AF_INET;
	server.sin_port = htons(PORT);
	server.sin_addr.s_addr = htonl(INADDR_ANY);
	if (bind(listenfd, (struct sockaddr *)&server, sizeof(server)) == -1)
	{
		perror("bind() error.\n");
		exit(1);
	}
	if(listen(listenfd, BACKLOG) == -1)
	{
		perror("listen() error.\n");
		exit(1);
	}
	len = sizeof(client);
	while(1)
	{
		if((connfd = accept(listenfd, (struct sockaddr *)&client, &len)) == -1)
		{
			perror("accept() error.\n");
			exit(1);
		}
		arg = (struct ARG *)malloc(sizeof(struct ARG));
		arg->connfd = connfd;
		memcpy((void *)&arg->client, &client,sizeof(client));
		if(pthread_create(&tid, NULL, function, (void*)arg))
		{
			perror("pthread_create() error.\n");
			exit(1);
		}
	}
	close(listenfd);
	return 0;
}

void process_cli(int connfd,struct sockaddr_in client)
{
	int num, i, j, n;
	char recvbuf[MAXDATASIZE],sendbuf[MAXDATASIZE],cli_name[MAXDATASIZE];
	int code[10] = {2, 0, 1, 5, 1, 2, 2, 0, 7, 5};
	printf("[!] You got a connection from: %s, the port is: %d\n", inet_ntoa(client.sin_addr), ntohs(client.sin_port));
	num = recv(connfd, cli_name, MAXDATASIZE, 0);
	if(num == 0)
	{
		close(connfd);
		printf("[!] Client disconnected.\n");
		return;
	}
	cli_name[num - 1] = '\0';
	printf("[>] Client's name is %s.\n",cli_name);
	while (num = recv(connfd, recvbuf, MAXDATASIZE, 0))
	{
		recvbuf[num] = '\0';
		printf("[>] Received client (%s) message: %s",cli_name,recvbuf);
		
		if((i = (num - 1) % 10) != 0)
		{
			for(j = 0; j < (10 - i); j++)
			{
				recvbuf[num - 1] = '0';
				num++;
			}
		}		
		
		for(n = 0; n < num / 10; n++)
		{
			for(i = 0; i < 10; i++)
			{		
				if(recvbuf[10 * n + i] >= '0' && recvbuf[10 * n + i] <= '9')
				{
					recvbuf[10 * n + i] += code[i];
					if(recvbuf[10 * n + i]>'9')
					{
						recvbuf[10 * n + i] -= 10;
					}
				}
				else if(recvbuf[10 * n + i] >= 'a' && recvbuf[10 * n + i] <= 'z')
				{
					recvbuf[10 * n + i] += code[i];
					if(recvbuf[10 * n + i] > 'z')
					{
						recvbuf[10 * n + i] -= 26;
					}
				}
				else if(recvbuf[10 * n + i] >= 'A' && recvbuf[10 * n + i] <= 'Z')
				{
					recvbuf[10 * n + i] += code[i];
					if(recvbuf[10 * n + i] > 'Z')
					{
						recvbuf[10 * n + i] -= 26;
					}
				}
				sendbuf[10 * n + i] = recvbuf[10 * n + i];
			}
		}
		sendbuf[num - 1] = '\0';
		send(connfd, sendbuf, strlen(sendbuf),0);
		printf("[>] Send message:%s\n",sendbuf);
		if(!strcmp(sendbuf, "sujy122075"))
		{
			printf("[>] Client (%s) quit.\n", cli_name);
			close(connfd);
			break;
		}
	}
	close(connfd);
}

void* function(void* arg)
{
	struct ARG *info;
	info = (struct ARG *)arg;
	process_cli(info->connfd, info->client );
	free(arg);
	pthread_exit(NULL); 
}

