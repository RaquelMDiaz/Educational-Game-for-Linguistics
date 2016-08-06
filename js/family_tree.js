// function that prints the family tree in a div called "family_tree_container", according to its current status:

function drawFamilyTree(missing_name, collected_names) { 
    // parameters: missing name = string (name1/name2/name3/final), indiactes where to place question marks
    // collected names: object literal of format {'name1': 'NAME', ...}, indicating which names user has collected already
    
    $('#family_tree_container').append('<canvas id="family_tree" width="400" height="120"></canvas>');
    var c = document.getElementById("family_tree");
    var ctx = c.getContext("2d");
            
    // draw image to the canvas:
    var imageObj = new Image();
    imageObj.onload = function() {
        ctx.drawImage(imageObj, 0, 0);
                
        //write names to the boxes (those that are always displayed):
        ctx.font = '9pt Calibri';
        ctx.fillText('Mun', 113, 14);
        ctx.fillText('Lihla', 176, 14);
        ctx.fillText('Maura', 340, 14);
        ctx.fillText('Majla', 258, 63);
        ctx.fillText('Nojman', 171, 113);
        ctx.fillText('Mula', 280, 113);
        
        //write other names, depending on which ones user has already found out:
        if (collected_names['name1'] !== false) {
            ctx.fillText(collected_names['name1'], 117, 113);
        }
        if (collected_names['name2'] !== false) {
            ctx.fillText(collected_names['name2'], 88, 63);
        }
        if (collected_names['name3'] !== false) {
            ctx.fillText(collected_names['name3'], 273, 14);
        }
        if (collected_names['name4'] !== false) {
            ctx.fillText(collected_names['name4'], 30, 63);
        }
        if (collected_names['name5'] !== false) {
            ctx.fillText(collected_names['name5'], 196, 63);
        }
        if (collected_names['name6'] !== false) {
            ctx.fillText(collected_names['name6'], 361, 63);
        }
        if (collected_names['name7'] !== false) {
            ctx.fillText(collected_names['name7'], 5, 113);
        }
        
        // mark the name the user is just solving:
        switch (missing_name) {
            case 'name1':
                ctx.fillStyle = '#990000';
                ctx.fillText('???', 118, 113);
                break;
                
            case 'name2':
                ctx.fillStyle = '#990000';
                ctx.fillText('???', 97, 63);
                break;
            
            case 'name3':
                ctx.fillStyle = '#990000';
                ctx.fillText('???', 283, 14);
                break;
                
            case 'final': //when Chosmky tower is accessed -> display numbers for the four missing names
                ctx.fillStyle = '#990000';
                ctx.fillText('1', 39, 63);
                ctx.fillText('2', 207, 63);
                ctx.fillText('3', 374, 63);
                ctx.fillText('4', 18, 113);
                break;
            
            default:
                break;
        }
                
                
    };
    imageObj.src = '../images/family_tree_skeleton.png';
    
}