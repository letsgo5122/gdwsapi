extends Button

# Called when the node enters the scene tree for the first time.
#func _ready():
#	pass # Replace with function body.

# Called every frame. 'delta' is the elapsed time since the previous frame.
#func _process(delta):
#	pass

func _on_Info_toggled(button_pressed):
	print("Info Button")
	if get_node("/root/").has_node("world"):
		if button_pressed:
			get_node("/root/lobby/CanvasLayer/InfoPanel").visible = true
			get_node("/root/world").visible=false
			get_node("/root/lobby/bg").visible = true
		else:
			get_node("/root/lobby/CanvasLayer/InfoPanel").visible = false
			get_node("/root/world").visible=true
			get_node("/root/lobby/bg").visible  = false
	else:
		print("world not ready")
	pass # Replace with function body.
