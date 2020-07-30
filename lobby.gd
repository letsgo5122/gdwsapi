extends Node

#var ShowPanel = false
func _ready():
	$CreateAccount/AccountPanel.visible = false
	gamestate.connect("refreshList", self, "refreshList")
	gamestate.connect("serverState", self, "serverState")
	pass # Replace with function body.

func _on_join_pressed(): 
	var new_player_name = $CanvasLayer/InfoPanel/userName.text
	$CanvasLayer/InfoPanel/serverStart.disabled = true
	$CanvasLayer/InfoPanel/join.disabled = true
	$bg.visible = false
	gamestate.join_game(new_player_name)
	#my_func()
	
	pass # Replace with function body.
	
func my_func():
	var js_return = JavaScript.eval("alert('Calling JavaScript per GDScript!');")
	print(js_return) 

func _on_serverStart_pressed():
	gamestate.serverStart()
	pass # Replace with function body.

func refreshList(players):
	$CanvasLayer/InfoPanel/ItemList.clear()
	for player_id in players:
		$CanvasLayer/InfoPanel/ItemList.add_item(players[player_id]["name"])
		
func serverState(player_stats):
	$CanvasLayer/InfoPanel/serverStart.text = player_stats["name"]
	$CanvasLayer/InfoPanel/serverStart.disabled = true
	$CanvasLayer/InfoPanel/join.disabled = true
	
func _on_newAccount_pressed():
	$CanvasLayer/InfoPanel.visible = false
	$CreateAccount/AccountPanel.visible = true
	pass # Replace with function body.

func _on_BackInfoPanel_pressed():
	$CanvasLayer/InfoPanel.visible = true
	$CreateAccount/AccountPanel.visible = false
	pass # Replace with function body.

func _on_Create_pressed():
	var u_name = $CreateAccount/AccountPanel/UserNameEdit.text
	var u_password = $CreateAccount/AccountPanel/passwordEdit.text
	#rpc_id(1,"save_account", u_name, u_password)
	#HTTPRequest

	
#func save_account(u_name,u_password):
remote func save_account(u_name,u_password):
	var save_user = {u_name:u_password}
	var account = File.new()
	if not account.file_exists("/home/pub/account.save"):
		account.open("/home/pub/account.save", File.WRITE)
	else:
		#If the file does not exist when use File.READ_WRITE will get errors
		account.open("/home/pub/account.save", File.READ_WRITE)
	account.seek_end()
	account.store_line(to_json(save_user))
	account.close()
	
func _on_ShowAccountBt_pressed():
	rpc_id(1, "check_account")
	#show_account()
	pass # Replace with function body.
	
#func show_account():
remote func check_account():
	var account = File.new()
	if not account.file_exists("/home/pub/account.save"):
		return #
	account.open("/home/pub/account.save", File.READ)
	var user_data =""
	while account.get_position() < account.get_len():
		#user_data += parse_json(account.get_line())
		user_data += account.get_line()
	#$CreateAccount/AccountPanel/AccountList.text = user_data
	account.close()
	rpc("show_account",user_data)

remotesync func show_account(user_data):
	$CreateAccount/AccountPanel/AccountList.text = user_data


