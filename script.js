var submit = document.querySelector("#send_data");
// console.log(inputed_data);
// console.log(submit);

submit.onclick = function(e){
    var inputed_data = document.querySelector("#data_from_fe").value;
    console.log(inputed_data);
    var data = {
        inputed_data: inputed_data
    };
    e.preventDefault();
    // console.log('clicked');
    fetch('/validation.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(data)
    }).then(function(response){
        // console.dir(response)
        return response.json();
    }).then(function (data_from_be) {
        console.dir(data_from_be);
        var rez = document.querySelector("#rez");
        rez.innerHTML = data_from_be.message;
    })
}