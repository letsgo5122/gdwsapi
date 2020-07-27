extends Button


# Called every frame. 'delta' is the elapsed time since the previous frame.
#func _process(delta):
#	pass
func _ready():
	get_parent().get_node("LineEdit").set_focus_mode(1)
	pass

func printMsg(name):
	var msg = "[color=#0000ff]"+name+"[/color]"+":"+get_parent().get_node("LineEdit").text+"\n"
	#var s = "test messages"
	rpc("printMessage",msg)
	
remotesync func printMessage(msg):
	
	get_node("../../RichTextLabel").append_bbcode(msg)
	get_parent().get_node("LineEdit").text = ""
	


