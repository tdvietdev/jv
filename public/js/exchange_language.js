function exchage_language() {

    var input = document.getElementById('input').value;
    var output = document.getElementById('output').value;
    document.getElementById('input').value = output;
    document.getElementById('output').value = input;
    var btn_input = document.getElementById('btn-input').value;
    if(btn_input == 'vi'){
        document.getElementById('btn-input').value = 'ja';
        document.getElementById('btn-input').innerHTML = 'Japanese';
        document.getElementById('btn-output').value = 'vi';
        document.getElementById('btn-output').innerHTML = 'Vietnamese';
    } else {
        document.getElementById('btn-input').value = 'vi';
        document.getElementById('btn-input').innerHTML = 'Vietnamese';
        document.getElementById('btn-output').value = 'ja';
        document.getElementById('btn-output').innerHTML = 'Japanese';
    }
}

