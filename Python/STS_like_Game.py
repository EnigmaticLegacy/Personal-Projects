import random
import time

def character():
    print("1. The Ironclad")
    print("2. The Silent(Not Available)")
    print("3. The Defect(Not Available)")
    choice = int(input("Choose your character(1/2/3): "))
    if choice == 1 :
        print("The Ironclad")
        maxhp = 80
        currenthp = 80
        print("Hp :",str(currenthp) + "/" + str(maxhp))
        print()
        return maxhp
    elif choice == 2 or choice == 3 :
        print("Character is in progress")
        return character()
    else :
        print("It's out of range")
        return character()
        
def draw(deck,discard):
    count = 0
    hand = []
    print("Cards in your hands:")
    while count < 5:
        if len(deck) == len(discard):
            discard = []
        num = random.randint(0,len(deck)-1)
        draw = deck[num]
        if num in discard:
            continue
        print(count+1,draw)
        hand.append(draw)
        discard.append(num)
        count += 1
    return discard,hand

def loot(cards,deck):
    counter = 0
    newcards = []
    while counter < 3:
        num = random.randint(0,len(cards)-1)
        newcard = cards[num]
        if num in discard:
            continue
        newcards.append(newcard)
        discard.append(num)
        counter+= 1
    for i in range(len(newcards)):
        print(i+1 , newcards[i])
    choose = int(input("Choose the card you want(1/2/3): "))
    if choose == 1 :
        deck.append(newcards[0])
    elif choose == 2 :
        deck.append(newcards[1])
    elif choose == 3 :
        deck.append(newcards[2])
    else:
        print("You decided not to take the cards")
    print()
    return deck

def monsterroom(upgrade):
    monsterl = ["c","j","s","l"]
    mn = random.randint(0,len(monsterl)-1)
    return monster(monsterl[mn],upgrade)

def monster(x,upgrade):
    print("You are fighting")
    if x == "c" :
        print("Cultist")
        hp = random.randint(50+upgrade,56+upgrade)
        currenthp = hp
        print("Hp :",str(currenthp) + "/" + str(hp))
        return x,currenthp
    elif x == "j" :
        print("Jaw Worm")
        hp = random.randint(42+upgrade,46+upgrade)
        currenthp = hp
        print("Hp :",str(currenthp) + "/" + str(hp))
        return x,currenthp
    elif x == "s" :
        print("Slaver")
        hp = random.randint(48+upgrade,52+upgrade)
        currenthp = hp
        print("Hp :",str(currenthp) + "/" + str(hp))
        return x,currenthp
    elif x == "l" :
        print("Looter")
        hp = random.randint(46+upgrade,50+upgrade)
        currenthp = hp
        print("Hp :",str(currenthp) + "/" + str(hp))
        return x,currenthp
    
def mmoves(x,mdmg,mblk,upgrade):
    if x == "c" :
        move = random.randint(1,3)
        if move == 1:
            mdmg = 9+upgrade
            print("Cultist is doing",mdmg,"damage")
        elif move == 2:
            mdmg = (5+upgrade)*2
            print("Cultist is doing",(mdmg//2),"damage two times")
        elif move == 3:
            mdmg = 7+upgrade
            print("Cultist is doing",mdmg,"damage")
    elif x == "j" :
        move = random.randint(1,3)
        if move == 1:
            mdmg = 11+upgrade
            print("Jaw Worm is doing",mdmg,"damage")
        elif move == 2:
            mdmg = 7+upgrade
            mblk = 5+upgrade
            print("Jaw Worm is doing",mdmg,"damage")
            print("Jaw Worm is gaining",mblk,"block")
        elif move == 3:
            mdmg = 3+upgrade
            mblk = 6+upgrade
            print("Jaw Worm is doing",mdmg,"damage")
            print("Jaw Worm is gaining",mblk,"block")
    elif x == "s" :
        move = random.randint(1,3)
        if move == 1:
            mdmg = 12+upgrade
            print("Slaver is doing",mdmg,"damage")
        elif move == 2:
            mdmg = (1+upgrade)*5
            print("Slaver is doing",(mdmg//5),"damage five times")
        elif move == 3:
            mdmg = (4+upgrade)*3
            print("Slaver is doing",(mdmg//3),"damage three times")
    elif x == "l" :
        move = random.randint(1,3)
        if move == 1:
            mdmg = 10+upgrade
            print("Looter is doing",mdmg,"damage")
        elif move == 2:
            mdmg = 14+upgrade
            print("Looter is doing",mdmg,"damage")
        elif move == 3:
            mblk = 6+upgrade
            mdmg = 3+upgrade
            print("Looter is doing",mdmg,"damage")
            print("Looter is gaining",mblk,"block")
    return mdmg,mblk

def turn(maxhp,currenthp,deck,tcount,discard,x,enemymaxhp,enemyhp,counter,upgrade):
    hand = []
    mdmg = 0
    mblk = 0
    print()
    print("Turn -" , tcount)
    print("Ironclad's Hp :",str(currenthp)+"/"+str(maxhp))
    print("Enemy's Hp :",str(enemyhp)+"/"+str(enemymaxhp))
    print()
    discard,hand = draw(deck,discard)
    mdmg,mblk = mmoves(x,mdmg,mblk,upgrade)
    energy = 3
    currentenergy = energy
    dmg,blk,minushp = playcard(hand,currentenergy)
    currenthp -= minushp
    
    if mblk >0 :
        mblk -= dmg
        if mblk < 0:
            enemyhp += mblk
    else :
        enemyhp -= dmg
    
    if enemyhp <= 0 :
        discard = []
        hand = []
        if  counter == 0:
            print("Congratulation!,Now you will fight another monster until you die!")
        else:
            print("Congratulation!.But there is no time to rest,you will fight another stronger monster")
        print()
        return currenthp
    if blk >0 :
        blk -= mdmg
        if blk < 0:
            currenthp += blk
    else :
        currenthp -= mdmg
    if currenthp <= 0 :
        credit(counter)
    return turn(maxhp,currenthp,deck,tcount+1,discard,x,enemymaxhp,enemyhp,counter,upgrade)
    
def playcard(hand,energy):
    ttldmg = 0
    ttlblk = 0
    ttlminushp = 0
    while True:
        play = int(input("Select the card that you want to play : ")) - 1
        if play > len(hand)-1:
            print("You only have",len(hand),"cards")
            return playcard(hand,energy)
        else:
            cardplayed = hand[play]
            dmg,blk,need,minushp = cardeffect(cardplayed)
            print("You are dealing",dmg,"damage and gaining",blk,"block")
            energy -= need
            if energy >= 0:
                ttldmg += int(dmg)
                ttlblk += int(blk)
                ttlminushp += int(minushp)
                print("You have",energy,"energy")
                del hand[play]
            elif energy < 0:
                print("Not enough energy")
                energy += need
            if energy == 0:
                break
            for i in range(len(hand)):
                    print(i+1,hand[i])
    return ttldmg,ttlblk,ttlminushp

def cardeffect(cardplayed):
    dmg = 0
    blk = 0
    need = 0
    minushp = 0
    if cardplayed == "strike":
        print("You played strike")
        dmg += 7
        need += 1
    elif cardplayed == "defend":
        print("You played defend")
        blk += 6
        need += 1
    elif cardplayed == "bash":
        print("You played bash")
        dmg += 12
        need += 2
    elif cardplayed == "anger":
        print("You played anger")
        dmg += 5
        need += 0
    elif cardplayed == "pommel strike":
        print("You played pommel strike")
        dmg += 9
        need += 1
    elif cardplayed == "shrug it off":
        print("You played shrug it off")
        blk += 9
        need += 1
    elif cardplayed == "twin strike":
        print("You played twin strike")
        dmg += 10
        need += 1
    elif cardplayed == "hemokinesis":
        print("You played hemokinesis")
        dmg += 16
        need += 1
        minushp += 3
        print("You lose",minushp,"Hp")
    elif cardplayed == "bludgeon":
        print("You played bludgeon")
        dmg += 25
        need += 3
    elif cardplayed == "impervious":
        print("You played impervious")
        blk += 30
        need += 2
    elif cardplayed == "power through":
        print("You played power through")
        blk += 9
        need += 1
    elif cardplayed == "ghostly armor":
        print("You played ghostly armor")
        blk += 9
        need += 1
    elif cardplayed == "iron wave":
        print("You played iron wave")
        dmg += 6
        blk += 6
        need += 1
    return dmg,blk,need,minushp

def credit(counter):
    print()
    print("You have been slain")
    print("You managed to kill",counter,"enemies")
    print("The end?")
    print()
    print("Made by Alvin Goliandi")
    print("Inspired by Slay the spire")
    print("===============================================================")
    print("Get the full version now at Steam!")
    print("Buy Slay the Spire now to play the full version!")
    time.sleep(1.5)
    quit()
    
def characterinfo(currenthp,maxhp):
    print("The Ironclad")
    print("Hp :",str(currenthp)+"/"+str(maxhp))
    
cards = ["anger","pommel strike","shrug it off","twin strike","hemokinesis","bludgeon","impervious","power through","ghostly armor","iron wave"]
deck = ["bash","defend","defend","defend","defend","strike","strike","strike","strike","strike",]
discard = []
tcount = 1
maxhp = character()
currenthp = int(maxhp)
counter = 0
upgrade = 0

for i in range(2):
    deck = loot(cards,deck)
        
while True:
    x,enemymaxhp = monsterroom(upgrade)
    enemyhp = enemymaxhp
    currenthp = turn(maxhp,currenthp,deck,tcount,discard,x,enemymaxhp,enemyhp,counter,upgrade)
    characterinfo(currenthp,maxhp)
    counter += 1
    upgrade += 1
    time.sleep(0.7)
