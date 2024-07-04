import sys
from sys import stdout, stderr, stdin

def Solve(*args):
    params = locals()['args']
    # Mencetak params, jika tidak digunakan dapat dihapus

    a, b, c, d, L = params
    cnt = 0
    if a == 0 and b == 0 and c == 0 and d == 0 and L == 0:
        pass
    else:
        for x in range(int(L)+1):
            if (((int(a) * x + int(b)) * x + int(c)) % int(d) == 0) :
                cnt += 1
    
    result = cnt   
    return result

def main():
    try:
        for line in inp:
            # Magic Formula
            print(Solve(*line.strip().split()))
    except:
        pass

# Mengambil semua input
inp = iter(stdin.readlines())
# Keluar dari Readlines tekan <Ctrl-D>

if __name__ == '__main__':
    main()
