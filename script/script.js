let Input = document.querySelector(".cont input");
let Addfile = document.querySelector(".cont .add-file");
let tasksContainer = document.querySelector(".mylist");


window.onload = function () {
  Input.focus();
};
$(document).on('click', "#myInput", function () {
  if(Input.value===""){
    console.log("Empty")
  }
  //to add list in todo list
  else{
    let mainDiv = document.createElement("div");
    let Element = document.createElement("span");
    let deleteElement = document.createElement("span");
    let editElement = document.createElement("span");
    let saveElement = document.createElement("span");
    let text = document.createTextNode(Input.value);
    Element.appendChild(text);
    mainDiv.className = 'target';
    Element.className ='text';
    Element.id ='text';
    deleteElement.className = 'far fa-times-circle close';
    editElement.className = 'far fa-edit edit edit1';
    saveElement.className = 'far fa-check-circle save';
    mainDiv.appendChild(Element);
    mainDiv.appendChild(deleteElement);
    mainDiv.appendChild(editElement);
    mainDiv.appendChild(saveElement);
    tasksContainer.appendChild(mainDiv);
    Input.value = '';
    Input.focus();
    save();
  }
});
//event on click
tasksContainer.addEventListener('click', function (e) {
  //to delete list
  if (e.target.classList.contains('close')) {
    e.target.parentNode.remove();
    const button = e.target;
    const parent = button.parentNode;
    const child =  parent.children[0];
    const id = child.textContent;
    del(id);
  }
  //to edit list
  if (e.target.classList.contains('edit1')) {
    const button = e.target;
    const parent = button.parentNode;
    const child = parent.children[1];
    const input = document.createElement('input');
    input.type = 'text';
    input.value = child.textContent;
    parent.appendChild(input);
    parent.insertBefore(input , child);
    parent.removeChild(child);
    button.classList.remove("edit1");
    const save = parent.children[4];
    save.className="far fa-check-circle save save1"
  }
  //to save edit list
  if (e.target.classList.contains('save1')) {
    const button = e.target;
    const parent = button.parentNode;
    const child = parent.children[1];
    const span = document.createElement('span');
    // input.type = 'text';
    span.textContent=child.value ;
    parent.appendChild(span);
    parent.insertBefore(span , child);
    parent.removeChild(child);
    button.classList.remove("save1");
    const edit = parent.children[3];
    edit.className="edit far fa-edit edit1"
    const target = parent.children[1];
    const newText = target.textContent;
    target.className ='text';
    target.id ='text';
    const id = parent.children[0].textContent;
    editon(id ,newText);
  }
  });
  //function to save list in database
  function save(){
    var text=$("#text").text();
    baseURL =window.location.protocol + "//" + window.location.host + "/todo";
    $.ajax({
      method: "post",
      url: baseURL + "/api/save",
      data :{content : text}
    })
    .done(function( msg ) {
      if(msg=="empty"){
        console.log("Empty")
      }
      window.location.reload();
  }); 
  } 
    //function to edit list in database
  function editon(id ,newText){
    baseURL =window.location.protocol + "//" + window.location.host + "/todo";
    $.ajax({
      method :"post",
      url: baseURL + "/api/edit",
      data :{newText : newText , id :id},
    })
      .done(function( msg ) {
        if(msg=="empty"){
        alert("your list is empty")
      }
      if(msg=="done"){
        alert("your list has been edited")
      }
  }); 
  }
    //function to delete list in database
  function del (id){
    baseURL =window.location.protocol + "//" + window.location.host + "/todo";
    $.ajax({
      method : "post",
      url : baseURL + "/api/del",
      data: {id :id}
    })
    .done(function( msg ) {
      if(msg=="done"){
        alert("your list has been deleted")
      }
  });
}
