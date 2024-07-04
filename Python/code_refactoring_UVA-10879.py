import sys
from sys import stdout, stderr, stdin

def Solve(*args):
    params = locals()['args']
    arg1, arg2 = params
    result = f"Case #{arg2}: {arg1}"
    count = 0
    i = 2
    while((i*2)<=arg1):
        if(arg1%i == 0):
            string = f" = {i} * {arg1/i}"
            result += string
            count += 1
        if(count == 2):
            break
        i += 1
    return result

def main():
    try:
        # Code Refactoring
        caseCount = int(next(inp))
        for i in range(caseCount):
            num = int(next(inp))
            print(Solve(num, i+1))
    except:
        pass

# Mengambil semua input
inp = iter(stdin.readlines())
# Keluar dari Readlines tekan <Ctrl-D>

if __name__ == '__main__':
    main()
