class Player:
    def __init__(self, health, food, energy):
        self.health = health
        self.food = food
        self.energy = energy


    def rest(self):
        if self.food > 0:
            self.food -= 1
            self.energy += 10
        else:
            print("Ei ole toitu!")

    
    def status(self, time_left):
        print(f"Tervis: {self.health}, Toit: {self.food}, Energia: {self.energy}, Aega jäänud: {time_left}")

time_left = 10
player = Player(health=100, food=3, energy=50)

def test_rest(player):
    print("Enne puhkust:")
    player.status(time_left=0)
    
    old_food = player.food
    old_energy = player.energy
    
    player.rest()
    
    print("Pärast puhkust:")
    player.status(time_left=0)

    if old_food > 0:
        assert player.food == old_food - 1
        assert player.energy == old_energy + 10
    else:
        assert player.food == old_food
        assert player.energy == old_energy


for i in range(5):
    print(f"\nKäik {i+1}")
    player.rest()
    time_left -= 1
    player.status(time_left)

print("\nTestime rest() funktsiooni:")
test_rest(player)