const listItems = document.querySelectorAll('#task-list .list-group-item');

listItems.forEach(item => {
    const text = item.textContent.toLowerCase();

    if (text.includes('ootel')) {
        item.classList.add('list-group-item-warning');
    } else if (text.includes('tehtud')) {
        item.classList.add('list-group-item-success');
    } else if (text.includes('viga')) {
        item.classList.add('list-group-item-danger');
    }
});
