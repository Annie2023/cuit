#include "windows.h"
#include <stdio.h>
#include <string.h>

char table[] = {0x0C, 0x0A, 0x13, 0x09, 0x0C, 0x0B, 0x0A, 0x08};

int function(char *userial, char *uname, int unamelen);

int main(int argc, char* argv[])
{
    char uName[8] = {0};
    char uPwd[8] = {0};  // 加密
    int len = 8;

    // 1. 使用scanf接收用户输入，给uName赋值abcd
    printf("请输入要加密的字符(字符长度<8): ");
    scanf("%7s", uName);  // 最多7个字符

    // 调用加密函数
    int ret = function(uPwd, uName, len);

    // 2. 使用printf输出加密后的uPwd
    printf("加密后的用户密码为: ");
    for (int i = 0; i < len; i++) 
	{
        printf("%02X ", (unsigned char)uPwd[i]);  // 以16进制形式输出
    }
    printf("\n");

    return 0;
}

int function(char *userial, char *uname, int unamelen)
{
    int  esi = 0;  // 对应于 esi
    int cnt = 3;       // 从第3个字符开始
    int eax = 0;       // 对应于 eax

    if (unamelen <= cnt) 
	{
        return 0;
    }

    // 遍历uname，计算userial
    while (cnt < unamelen) 
	{
        if (eax >= 7) 
		{
            eax = 0;  // 如果超过7（表的长度），则重置eax
        }

        // 获取uname中的字符并与table对应元素相乘
        int dl = uname[cnt];    // uname[i] 对应于 dl
        int bl = table[eax];    // table[eax] 对应于 bl
        
         esi += dl * bl;    // 乘积累加

        userial[cnt] = dl * bl;  // 将结果存放到userial对应位置

        cnt++;  // cnt递增
        eax++;  // eax递增
    }

    return  esi;
}




