.386                                      ;INCLUDE Irvine32.inc
.model flat, stdcall                      ;INCLUDE Irvine32.inc
.stack 4096                               ;INCLUDE Irvine32.inc

ExitProcess proto , dwExitCode:DWORD      ;INCLUDE Irvine32.inc
MessageBoxA  proto , hWnd:DWORD, lpText:DWORD, lpCaption:DWORD, uType: DWORD

.data
lpCaption db "Caption of dialog box",0
lpText    db "text in the dialog box", 0

.code
main PROC
        push 0               ; for MB_OK
	push offset lpCaption
	push offset lpText
	push 0               ; for NULL
	call MessageBoxA

	push 0               ; exit
	call ExitProcess
main ENDP
END main