$(document).ready(function () {
    var bsCodeMirror = CodeMirror.fromTextArea(document.getElementById("article_entity_content"), {
        lineNumbers: true,
        lineWrapping: true,
        theme: "darcula",
        mode : "xml",
        htmlMode: true,
    });
});


