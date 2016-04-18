import webapp2
from google.appengine.api import users
from models import Item
from handlers import BaseHandler

class ItemInput(webapp2.RequestHandler):
	def post(self):
		#Getting Inputs
		itemtable=self.request.get("table_number")
		itempurchasername=self.request.get("person_name")
		itemdrinkname=self.request.get("drink_name")
		itemdelivery=self.request.get("pick_up")
			
		#Placing data in model	
		item=Item()
		item.table=itemtable
		item.person_name=itempurchasername
		item.drink_name=itemdrinkname
		item.pick_up=itemdelivery
		
		
		item.put()
		self.redirect('success')
		
