import redis
import json
from datetime import datetime,timedelta
import sys

r = redis.Redis(host='localhost', port=6379, decode_responses=True)



#register class

#add to redis for the first register of user

def register(user):
    print(user)
    with open(user, 'r') as f:
        infos = json.load(f)
    
    infos["last_login"] = datetime.now().isoformat()
    infos["nb_connection"] = 1
    data_json = json.dumps(infos)
    print(data_json)
    r.set(infos["email"],data_json)

        
if __name__ == '__main__':
    user = sys.argv[1]
    # user = {"name":"g","email":"g@g.g","lastname":"g","password":"g"}
    register(user)
    
