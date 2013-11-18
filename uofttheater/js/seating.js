
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
    });

    var seat_3 = new Kinetic.Rect({
        x: 200,
        y: 75,
        width: 25,
        height: 25,
        fill: 'green',
        stroke: 'black',
        strokeWidth: 4
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