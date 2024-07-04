import sys
from sys import stdout, stderr, stdin
import math

def Solve(*args):
    params = locals()['args']
    a = int(params[0])
    b = int(params[1])
    c = int(params[2])
    d = int(params[3])
    e = int(params[4])
    f = int(params[5])
    box = 0
    
    box += f + e + d
    a -= 11*e
    b -= 5*d
    
    box += math.floor(c / 4)
    if c % 4 == 1:
        a = a - 7
        b = b - 5
        box = box + 1
    elif c % 4 == 2:
        a = a - 6
        b = b - 3
        box = box + 1
    elif c % 4 == 3:
        a = a - 5
        b = b - 1
        box = box + 1
    
    if b > 0:
        box += math.floor(dua/9)
        if b % 9 != 0:
            a -= 36-(b % 9)*4
            box = box + 1
    elif b < 0:
        a += b*4
        
    if a > 0:
        box += a / 36
        if a % 36 != 0:
            box = box + 1
            
    return math.floor(box)

def main():
    try:
        for line in inp:
            if (line.strip() == '0 0 0 0 0 0'):
                break
            print(Solve(*line.strip().split()))
    except:
        pass

# Mengambil semua input
inp = iter(stdin.readlines())
# Keluar dari Readlines tekan <Ctrl-D>

if __name__ == '__main__':
    main()
