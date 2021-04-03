tinymce.init({
    selector: 'textarea#descricao',
    height: 350,
    menubar: false,
    plugins: [
      'advlist autolink lists charmap print preview anchor',
      'searchreplace visualblocks code fullscreen',
      'table paste code  wordcount'
    ],
    toolbar:'bold italic | removeformat',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
  });