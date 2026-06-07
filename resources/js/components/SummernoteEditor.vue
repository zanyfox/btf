<template>
  <div ref="editor"></div>
</template>

<script>
import { ref, onMounted, onBeforeUnmount, watch } from 'vue'
import $ from 'jquery'
import 'summernote/dist/summernote-lite.min.css'
import 'summernote/dist/summernote-lite.min.js'

export default {
  name: 'SummernoteEditor',
  props: {
    modelValue: String,
  },
  emits: ['update:modelValue', 'change'],

  setup(props, { emit }) {
    const editor = ref(null);
    let summernoteInstance = null;

    // Инициализация Summernote
    onMounted(() => {
      summernoteInstance = $(editor.value).summernote({
        toolbar: [
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough']],
          ['para', ['ul', 'ol']],
          ['insert', ['link', 'picture']],
        ],
        height: 200,
        callbacks: {
          onChange: (content) => {
            emit('update:modelValue', content);
            emit('change', content);
          },
          onInit: () => {
            if (props.modelValue) {
              $(editor.value).summernote('code', props.modelValue);
            }
          }
        }
      });
    });

    // Обновление контента при изменении modelValue
    watch(() => props.modelValue, (newValue) => {
      if (summernoteInstance && newValue !== $(editor.value).summernote('code')) {
        $(editor.value).summernote('code', newValue);
      }
    });

    // Уничтожение Summernote при размонтировании
    onBeforeUnmount(() => {
      if (summernoteInstance) {
        $(editor.value).summernote('destroy');
      }
    });

    return { editor };
  }
};
</script>

<style scoped>
.note-editable {
  min-height: 200px;
}
</style>
