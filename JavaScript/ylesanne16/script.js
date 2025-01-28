 const mobList = document.getElementById('mob');

 mobList.addEventListener('click', function (event) {
   const target = event.target;
   
   if (target.tagName === 'LI' || target.tagName === 'SPAN') {
     const hiddenSpan = target.tagName === 'LI' 
       ? target.querySelector('.peida') 
       : target;
     
     if (hiddenSpan && hiddenSpan.classList.contains('peida')) {
       hiddenSpan.classList.remove('peida');
     }
   }
 });