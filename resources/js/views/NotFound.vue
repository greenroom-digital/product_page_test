<!-- resources/js/components/NotFound.vue -->
<template>
  <div class="not-found container vh-100 d-flex justify-content-center align-items-center">
    <div class="row">
      <div class="col-12">
        <h1>404</h1>
      </div>
      <div class="col-12">
        <p>Oops! The page you're looking for doesn't exist.</p>
         <router-link to="/" class="mt-8 inline-block px-4 py-2 font-bold primary rounded-md">Home</router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'NotFound',
};
</script>

<style scoped>
.not-found {
  text-align: center;
  padding: 50px;
  font-family: Arial, sans-serif;
}
.not-found h1 {
  font-size: 100px;
  margin: 0;
}
.not-found p {
  font-size: 20px;
}
.not-found a {
  color: #3490dc;
  text-decoration: none;
}
.not-found a:hover {
  text-decoration: underline;
}
h1{
    color: hsl(26, 100%, 55%);
    font-weight: bold;
}
</style>
