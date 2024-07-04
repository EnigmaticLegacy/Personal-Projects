def check_prima(aab):
        for aba in range(2,aab):
            if aab % aba == 0:
                return False
        return True
def main():
    print("Pencari Bilangan Prima")
    print("Masukkan Range untuk mencari bilangan prima")
    cba = int(input("Range : "))
    baa = []
    for aab in range (2,cba):
        if(check_prima(aab)):
            baa.append(aab)
    print(baa)
    input("Press enter to Continue")


if __name__ == '__main__':
    main()