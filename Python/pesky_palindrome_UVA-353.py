import sys
from sys import stdout, stderr, stdin

def Solve(*args):
    params = locals()['args']

    arg1, = params
    hasil = 0
    letters = []
    for i in range(len(arg1)):
        a = 0
        while i + a <= len(arg1):
            letters.append(arg1[i:i+a])
            a += 2

    for strings in letters:
        is_palindrome = True
        if len(strings) == 1:
            hasil += 1
        else:
            for index in range(len(strings)//2):
                if strings[index] == strings[(-index)-1]:
                    pass
                else:
                    is_palindrome = False
                    break
            if is_palindrome:
                hasil += 1

    result = "The string '%s' contains %d palindromes" % (arg1,hasil)
    return result

def main():
    try:
        for line in inp:
        # Palindrom
            print(Solve(line.strip()))
    except:
        pass

# Mengambil semua input
inp = iter(stdin.readlines())
# Keluar dari Readlines tekan <Ctrl-D>

if __name__ == '__main__':
    main()
