
$(document).ready(function(){
    var stage = new Kinetic.Stage({
        container: 'container',
        width: 578,
        height: 200
    });

    var layer = new Kinetic.Layer();

    var seat_1 = new Kinetic.Rect({
        x: 120,
        y: 75,
        width: 25,
        height: 25,
        fill: 'green',
        stroke: 'black',
        strokeWidth: 4
    });

    var seat_2 = new Kinetic.Rect({
        x: 150,
        y: 75,
        width: 25,
        height: 25,
        fill: 'green',
        stroke: 'black',
        strokeWidth: 4
    })

    var seat_3 = new Kinetic.Rect({
        x: 200,
        y: 75,
        width: 25,
        height: 25,
        fill: 'green',
        stroke: 'black',
        strokeWidth: 4
    })


    seat_1.on('click', function(){
        var seatsTaken = $.get("", function(data){

        });
        if(seat_1.getFill() == 'green'){
            seat_1.setFill('yellow');
            layer.draw();
        }
        else{
            seat_1.setFill('green');
            layer.draw();
        }
    });


    // add the shape to the layer
    layer.add(seat_1);
    layer.add(seat_2);
    layer.add(seat_3);


    // add the layer to the stage
    stage.add(layer);
});