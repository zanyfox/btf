<template>
  <div class="auth-main">
    <div class="auth-wrapper v1">
      <div class="auth-form">
        <div class="position-relative my-5">
          <div class="card mb-0">
            <div class="card-body">
              <div class="text-center">
                <img src="/favicon.svg" alt="">
              </div>
              <h4 class="text-center f-w-500 mt-4 mb-3">{{ title }}</h4>
              <slot></slot>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
  defineProps(['title'])
</script>
