import sys
from sys import stdout, stderr, stdin

def changeLineToIntArray(line):
    arr = line.split()
    return [int(i) for i in arr]

def mxCopyingBooks(arr, minimum, maksimum, k):
    mid = (minimum + maksimum)//2
    t = 1
    total = 0
    if(minimum >= maksimum):
        return maksimum
    for i in range(len(arr)):
        if(total + arr[i] > mid):
            t += 1
            total = 0
        total += arr[i]
    if(t > k): return mxCopyingBooks(arr, mid+1, maksimum,k)
    else: return mxCopyingBooks(arr, minimum, mid, k)
    

def Solve(*args):
    params = locals()['args']
    m, k, arr = params[0], params[1], params[2]
    minimum = maksimum = 0
    for i in range(m):
        if(arr[i] > minimum):
            minimum = arr[i]
        maksimum += arr[i]
    maksimum = mxCopyingBooks(arr, minimum, maksimum, k)
    
    total = 0
    sc = k-1
    info = [0]*501
    
    for i in range(m-1, -1, -1):
        if((arr[i] + total > maksimum) or (sc == i + 1)):
            sc -= 1
            info[i] = 1
            total = 0
        total += arr[i]

    if(m == 1):
        print(arr[0], end = "")
    else:
        print(arr[0], end = " ")
    if(info[0]):
        print("/", end = " ")
    for i in range(1, m):
        print(arr[i], end = "")
        if(i != m-1):
            print(end = " ")
        if(info[i]):
            print("/", end = " ")
    
    return ""

def main():
    try:
        idx = 0
        while(True):
            line = next(inp).strip()
            N = int(line)

            for i in range(N):
                line = next(inp).strip()
                m, k = changeLineToIntArray(line)
                line = next(inp).strip()
                p = changeLineToIntArray(line)
                print(Solve(m, k, p))
    except:
        pass

# Mengambil semua input
inp = iter(stdin.readlines())
# Keluar dari Readlines tekan <Ctrl-D>

if __name__ == '__main__':
    main()
