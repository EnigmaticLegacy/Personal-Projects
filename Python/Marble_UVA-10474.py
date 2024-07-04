import sys
from sys import stdout, stderr, stdin

def changeLineToIntArray(line):
    arr = line.split()
    return [int(i) for i in arr]

def Solve(*args):
    params = locals()['args']
    marble = params[2]
    array = params[3]
    marble.sort()
    case = "CASE# "+str(params[4])+":"
    print(case)
    result =""
    for i in range (len(array)):
        pointer = -1
        cek = int(array[i])
        x = 0
        y = len(marble)-1
        while (x <= y):
            mid = (x + y)//2
            if (int(marble[mid]) == cek):
                pointer = mid
            if (int(marble[mid]) >= cek):
                y = mid - 1
            else :
                x = mid + 1
        if (pointer >= 0):
            result += str(cek)+" found at "+str(pointer+1)+"\n"
        else :
            result += str(cek)+" not found"+"\n"
    return result

def main():
    try:
        case = 0
        while(True):
            firstLine = next(inp).strip()
            N, Q = changeLineToIntArray(firstLine)
            if N == Q and N == 0:
                break
            
            marble = [int(next(inp).strip()) for i in range(N)]
            array = [int(next(inp).strip()) for i in range(Q)]
            case += 1
            
            print(Solve(N, Q, marble, array, case),end="")
    except (err):
        pass

# Mengambil semua input
inp = iter(stdin.readlines())
# Keluar dari Readlines tekan <Ctrl-D>

if __name__ == '__main__':
    main()
