#Punjab Lahore Awesome 5 true
#Punjab Islamabad Okay 3 true
#Sindh Karachi Good 4 false
#Sindh Karachi Great 4 true

import random

states = ["Washington","Oregon","California","Texas","Idaho","Nevada","Alaska"]
cities = {"Washington":["Spokane","Seattle","Bellevue","Tacoma"],
		"Oregon":["Portland","Eugene","Salem","Bend"],
		"California":["San Francisco","Los Angeles","San Diego","Sacramento","Oakland","San Jose","Santa Barbara"],
		"Texas":["Houston","Dallas","Austin","El Paso"],
		"Idaho":["Boise","Idaho Falls","Nampa"],
		"Nevada":["Las Vegas","Reno","Henderson"],
		"Alaska":["Anchorage","Juneau","Fairbanks"]}
comments = ["Terrible","Bad","Okay","Good","Excellent"]

fh = open("yelp.txt","w")

for i in range(10000000): 
	state = random.choice(states)
	city = random.choice(cities[state])
	comment = random.choice(comments)
	score = random.randint(0,5)
	goodForKids = random.choice(["true","false"])
	fh.write(state+","+city+","+comment+","+str(score)+","+goodForKids+"\n");
