#include "windows.h"
#include <stdio.h>
#include <string.h>

char table[] = {0x0C, 0x0A, 0x13, 0x09, 0x0C, 0x0B, 0x0A, 0x08};

int function(char *userial, char *uname, int unamelen);

int main(int argc, char* argv[])
{
    char uName[8] = {0};
    char uPwd[8] = {0};  // ����
    int len = 8;

    // 1. ʹ��scanf�����û����룬��uName��ֵabcd
    printf("������Ҫ���ܵ��ַ�(�ַ�����<8): ");
    scanf("%7s", uName);  // ���7���ַ�

    // ���ü��ܺ���
    int ret = function(uPwd, uName, len);

    // 2. ʹ��printf������ܺ��uPwd
    printf("���ܺ���û�����Ϊ: ");
    for (int i = 0; i < len; i++) 
	{
        printf("%02X ", (unsigned char)uPwd[i]);  // ��16������ʽ���
    }
    printf("\n");

    return 0;
}

int function(char *userial, char *uname, int unamelen)
{
    int esi = 0;  // ��Ӧ�� esi
    int cnt = 3;       // �ӵ�3���ַ���ʼ
    int eax = 0;       // ��Ӧ�� eax

    if (unamelen <= cnt) 
	{
        return 0;
    }

    // ����uname������userial
    while (cnt < unamelen) 
	{
        if (eax >= 7) 
		{
            eax = 0;  // �������7����ĳ��ȣ���������eax
        }

        // uname�е��ַ�����֪��table��ӦԪ�����
        int dl = uname[cnt];    // uname[cnt] ��Ӧ�� dl
        int bl = table[eax];    // table[eax] ��Ӧ�� bl
        
         esi += dl * bl;    // �˻��ۼ�

        userial[cnt] = dl * bl;  // �������ŵ�userial��Ӧλ��

        cnt++;  // cnt����
        eax++;  // eax����
    }

    return  esi;
}




