
$(document).ready(function(){
    var stage = new Kinetic.Stage({
        container: 'container',
        width: 578,
        height: 200
    });

    var layer = new Kinetic.Layer();
    
    var seat1_status = document.getElementById("1").value;
    var seat2_status = document.getElementById("2").value;
    var seat3_status = document.getElementById("3").value;
    
    var seat1_color = 'green';
    
    if (seat1_status == 'clear'){
    	seat1_color = 'white';
    } else if (seat1_status == 'select'){
    	seat1_color = 'green';
    } else {
    	seat1_color = 'yellow';
    }
    
    var seat2_color = 'green';
    
    if (seat2_status == 'clear'){
    	seat2_color = 'white';
    } else if (seat2_status == 'select'){
    	seat2_color = 'green';
    } else {
    	seat2_color = 'yellow';
    }
    
    var seat3_color = 'green';
    
    if (seat3_status == 'clear'){
    	seat3_color = 'white';
    } else if (seat2_status == 'select'){
    	seat3_color = 'green';
    } else {
    	seat3_color = 'yellow';
    }

    var seat_1 = new Kinetic.Rect({
        x: 120,
        y: 75,
        width: 25,
        height: 25,
        fill: seat1_color,
        stroke: 'black',
        strokeWidth: 2
    });

    var seat_2 = new Kinetic.Rect({
        x: 150,
        y: 75,
        width: 25,
        height: 25,
        fill: seat2_color,
        stroke: 'black',
        strokeWidth: 2
    });

    var seat_3 = new Kinetic.Rect({
        x: 200,
        y: 75,
        width: 25,
        height: 25,
        fill: seat3_color,
        stroke: 'black',
        strokeWidth: 2
    });
    
    seat_1.on('mousedown', function() {
    	console.log(seat1_status);
        if (seat1_status == 'clear'){
        	this.setFill('green');
        	
        	seat1_status = 'select';
        	seat1_color = 'green';
        	document.getElementById("1").value = 'select';
        	if (seat2_status == 'select'){
        		document.getElementById("2").value = 'clear';
        		seat_2.setFill('white');
        		seat2_status = 'clear';
        		seat2_color = 'white';
        	}
        	if (seat3_status == 'select'){
        		document.getElementById("3").value = 'clear';
        		seat_3.setFill('white');
        		seat3_status = 'clear';
        		seat3_color = 'white';
        	}
        }
        layer.draw();
    });
    
    seat_2.on('mousedown', function() {
    	console.log(seat2_status);
        if (seat2_status == 'clear'){
        	this.setFill('green');
        	seat2_status = 'select';
        	seat2_color = 'green';
        	document.getElementById("2").value = 'select';
        	if (seat1_status == 'select'){
        		document.getElementById("1").value = 'clear';
        		seat_1.setFill('white');
        		seat1_status = 'clear';
        		seat1_color = 'white';
        	}
        	if (seat3_status == 'select'){
        		document.getElementById("3").value = 'clear';
        		seat_3.setFill('white');
        		seat3_status = 'clear';
        		seat3_color = 'white';
        	}
        layer.draw();
        }
    });

    seat_3.on('mousedown', function() {
    	console.log(seat3_status);
        if (seat3_status == 'clear'){
        	this.setFill('green');
        	seat3_status = 'select';
        	seat3_color = 'green';
        	document.getElementById("3").value = 'select';
        	if (seat2_status == 'select'){
        		document.getElementById("2").value = 'clear';
        		seat_2.setFill('white');
        		seat2_status = 'clear';
        		seat2_color = 'white';
        	}
        	if (seat1_status == 'select'){
        		document.getElementById("1").value = 'clear';
        		seat_1.setFill('white');
        		seat1_status = 'clear';
        		seat1_color = 'white';
        	}
        layer.draw();
        }
    });


    var text_1 = new Kinetic.Text({
        x: 120,
        y: 105,
        text: "Seat 1",
        fontSize: 10,
        fontFamily: 'Calibri',
        fill: 'blue'
    });

    var text_2 = new Kinetic.Text({
        x: 150,
        y: 105,
        text: "Seat 2",
        fontSize: 10,
        fontFamily: 'Calibri',
        fill: 'blue'
    });

    var text_3 = new Kinetic.Text({
        x: 200,
        y: 105,
        text: "Seat 3",
        fontSize: 10,
        fontFamily: 'Calibri',
        fill: 'blue'
    });

    // add the shape to the layer
    layer.add(seat_1);
    layer.add(seat_2);
    layer.add(seat_3);
    layer.add(text_1);
    layer.add(text_2);
    layer.add(text_3);
    
    


    // add the layer to the stage
    stage.add(layer);
});