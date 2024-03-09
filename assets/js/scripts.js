const dropdown=document.querySelector("#drop")
const dropdownitem=document.querySelector("#drpit")


dropdown.addEventListener('click',(e)=>{
    console.log(e.currentTarget);
    dropdownitem.classList.toggle("drpcl")
})