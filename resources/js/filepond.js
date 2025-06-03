import { create,registerPlugin } from 'filepond'
import 'filepond/dist/filepond.min.css';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';

// Import the plugin code
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';

registerPlugin(FilePondPluginImagePreview,FilePondPluginFileValidateType);

const inputsSingle = document.querySelectorAll('.file-pond-single');
const inputsMultiple = document.querySelectorAll('.file-pond-multiple');

inputsSingle.forEach(input => {
    const pond = create(input, {
        storeAsFile: true,
        allowImagePreview: true,
        imagePreviewMaxHeight: 50,
        maxFiles: 1,
    });
    window[`pond_${input.id}`] = pond;
});
inputsMultiple.forEach(input => {
    const pond = create(input, {
        storeAsFile: true,
        allowImagePreview: true,
        imagePreviewMaxHeight: 50
    });
    window[`pond_multiple_${input.id}`] = pond;
});



