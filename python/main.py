import redis
import json
from datetime import datetime,timedelta
import time


r = redis.Redis(host='localhost', port=6379, decode_responses=True)





def can_connect(user_id):
    """user id"""
    user = r.get(user_id)
    user_data = json.loads(user)
    print(f"ICICICIICICIC {user}")
    last_time = datetime.fromisoformat(user_data["last_login"])
    interval = datetime.now() - last_time
    #Last connexion was more than 10 minutes ago
    if interval > timedelta(minutes=10):
        print("More than 10 minutes")
        print(interval)
        #connect to the serv and add 1 to the number of connection
        user_data['nb_connection'] =1
        user_data['last_login'] = datetime.now().isoformat()
        user = json.dumps(user_data)
        r.set(user_id,user)
        
        return True
    #Last connexion was less than 10 minutes ago
    else:
        #Check how many times the user has connected in the last 10 minutes
        if user_data['nb_connection'] < 10:
            #connect to the serv and add 1 to the number of connection
            user_data['nb_connection'] += 1
            print(f"Less than 10 minutes  and {user_data['nb_connection']} connections")
            user = json.dumps(user_data)
            r.set(user_id,user)
            return True
        else:
            wait_time = timedelta(minutes=10) - interval
            print(f"You have reached the maximum number of connections wait {wait_time} minutes before trying again")
            return False
        
        
if __name__ == '__main__':
    
    # Create a user
    user_data = {
        'id':1,
        'name':'prout',
        'lastname':'caca',
        'email':'caca.prout@test.com',
        'password':'proutcaca',
        'last_login':datetime.now().isoformat(),
        'nb_connection':1
    }

    user_json = json.dumps(user_data)
    for i in range(10):
    # Save user in redis
    # time.sleep(10)
        can_connect(1)
    
