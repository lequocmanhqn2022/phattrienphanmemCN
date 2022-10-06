setInterval(() => {
    let ajax = new XMLHttpRequest();
    ajax.open('GET' ,'/WebNuocHoa/admin/page-admin.php');
    ajax.send();
}, 1000);