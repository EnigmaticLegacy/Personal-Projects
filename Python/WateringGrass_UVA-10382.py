import sys, math
from sys import stdout, stderr, stdin

def changeLineToIntArray(line):
    arr = line.split()
    return [int(i) for i in arr]

def Solve(*args):
    params = locals()['args']
    n = params[0]
    l = params[1]
    w = params[2]
    count = 0
    lahan = 0.0
    arr = []
    status = 0
    for i in range(n):
        letak = params[3][i][0]
        r = params[3][i][1]
        if (r*2 > w):
            dx = math.sqrt((r*r)-(w*w/4))
            kiri = letak - dx
            kanan = letak + dx
            arr.append([kiri,kanan])
    arr.sort()
    
    for i in range(len(arr)):
        if arr[i][0] > lahan:
            break
        for j in range(i+1,len(arr)):
            if(arr[j][0] <= lahan and arr[j][1] > arr[i][1]):
                i = j
        count += 1
        lahan = arr[i][1]
        if lahan >= l:
            return count
    return -1 

def main():
    try:
        while(True):
            firstLine = next(inp).strip()
            N, L, W = changeLineToIntArray(firstLine)
            
            sprinklers = []
            for i in range(N):
                sprinkler = next(inp).strip()
                a, b = changeLineToIntArray(sprinkler)
                
                sprinklers.append((a,b))
            print(Solve(N,L,W, sprinklers))
    except:
        pass

# Mengambil semua input
inp = iter(stdin.readlines())
# Keluar dari Readlines tekan <Ctrl-D>

if __name__ == '__main__':
    main()
