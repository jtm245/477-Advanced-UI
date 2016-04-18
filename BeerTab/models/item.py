from google.appengine.ext import ndb
from google.appengine.api import users

	
class Item(ndb.Model):
	table = ndb.StringProperty(required=True)
	person_name = ndb.StringProperty(required=True)
	drink_name = ndb.StringProperty()
	status = ndb.BooleanProperty()
	date = ndb.DateTimeProperty(auto_now_add=True)
	pick_up = ndb.StringProperty(required=True)
	