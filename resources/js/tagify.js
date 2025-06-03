import Tagify from '@yaireo/tagify';
import '@yaireo/tagify/dist/tagify.css';
const input = document.querySelector('input[name="tags"]');
if (input) {
    new Tagify(input);
}