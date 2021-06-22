import { Controller } from 'stimulus';
import jQuery from 'jquery';

export default class extends Controller {
    connect() {
        jQuery(document).ready(() => {
            let textarea = jQuery('textarea');
            let options = {
                toolbar: [
                    'fontFamily',
                    'fontSize',
                    'fontColor',
                    'fontBackgroundColor',
                    '|',
                    'alignment',
                    'bold',
                    'italic',
                    'underline',
                    'link',
                    'bulletedList',
                    'numberedList',
                    '|',
                    'undo',
                    'redo'
                ]
            }
            ClassicEditor.create(textarea[0], options).then(editor => {
                window.editor = editor;
            }).catch(error => {
                console.error('Oops, something went wrong!');
                console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
                console.warn('Build id: 5s2s2h89bq06-p1tf4q6taw6e');
                console.error(error);
            });
            if (1 in textarea) {
                ClassicEditor.create(textarea[1], options).then(editor => {
                    window.editor = editor;
                }).catch(error => {
                    console.error('Oops, something went wrong!');
                    console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
                    console.warn('Build id: 5s2s2h89bq06-p1tf4q6taw6e');
                    console.error(error);
                });
            }
        });

    }
}
