let updateCorrectOption = (data, url) => {
    $.post(url, data, function(response){
        
        console.log(response);

        toastr.success(response.message, response.status);
    });
}