def main():
    while(True):
        print("Welcome to Simple Calculator")
        print("1. Penambahan")
        print("2. Perkalian")
        print("3. Pembagian")
        print("4. Pemangkatan")
        print("5. Keluar")
        cba = int(input("Pilihan :"))
        if cba == 1:
            print("Penambahan")
            aab = int(input("Masukkan Nilai Pertama :"))
            baa = int(input("Masukkan Nilai Kedua :"))
            print(aab + baa)
        elif cba == 2:
            print("Perkalian")
            aab = int(input("Masukkan Nilai Pertama :"))
            baa = int(input("Masukkan Nilai Kedua :"))
            print(aab * baa)
        elif cba == 3:
            print("Pembagian")
            aab = int(input("Masukkan Nilai Pertama :"))
            baa = int(input("Masukkan Nilai Kedua :"))
            if aab == 0:
                print("error")
            else:
                print(aab / baa)
        elif cba == 4:
            print("Pemangkatan")
            aab = int(input("Masukkan Nilai Pertama :"))
            baa = int(input("Masukkan Nilai Kedua :"))
            print(aab ** baa)
        elif cba == 5:
            break
        input("Press enter to Continue")


if __name__ == '__main__':
    main()