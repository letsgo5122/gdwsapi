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
	var trimname = u_name.strip_edges(true,true)
	if trimname != "":
		var url = gamestate.SERVER_PHP+"/"+"gdapi.php"
		#post json
		var act = "insert"
		var data_to_send = {"act":act,"name":trimname,"passwd":u_password}
		var query = JSON.print(data_to_send)
		# Add 'Content-Type' header:
		var headers = ["Content-Type: application/json"]
		var error = $HTTPPost.request(url, headers, false, HTTPClient.METHOD_POST, query)
		if error != OK:
			push_error("An error occurred in the HTTP request.")
	else:
		$CreateAccount/AccountPanel/AccountList.text = "Please Enter User Name And Nick Name."


func _on_HTTPPost_request_completed(result, response_code, headers, body):
	if result == HTTPRequest.RESULT_SUCCESS:
		if response_code == 200 :
			#print(body.get_string_from_utf8())
			var json = JSON.parse(body.get_string_from_utf8())
			print(json.result)
			if !json.result.empty():
				for ar in json.result:
					$CreateAccount/AccountPanel/AccountList.text = ""
					$CreateAccount/AccountPanel/AccountList.append_bbcode(str(ar.get('id'))+":"+ar.get('name')+"\n")
			else:
				$CreateAccount/AccountPanel/AccountList.text = "Username Already Exist."
		else:
			$CreateAccount/AccountPanel/AccountList.text = "err code:"+str(response_code)
