import redis
import json
from datetime import datetime,timedelta
import sys

r = redis.Redis(host='localhost', port=6379, decode_responses=True)



#register class

#add to redis for the first register of user

def register(infos):
    infos["last_login"] = datetime.now().isoformat()
    infos["nb_connection"] = 1
    data_json = json.dumps(infos)
    print(data_json)
    r.set(infos["email"],data_json)

        
if __name__ == '__main__':
    user = sys.argv[1]
    # user = {
    #     "name":"name",
    #     "last_name":"last_name",
    #     "email":"email@email.email",
    #     "password":"password",
    # }
    register(user)
    
