// import './assets/main.css'

// import { createApp } from 'vue'
// import App from './App.vue'
// import {} from 'vue-router'

// createApp(App).mount('#app')


//main.ts
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import { createPinia } from 'pinia';
import App from './App.vue';
 
// 导入组件
import MusicList from '@/components/MusicList.vue';
import MusicPlay from '@/components/MusicPlay.vue';
 
// 创建 Pinia 实例
const pinia = createPinia();
 
// 创建路由
const router = createRouter({
  history: createWebHistory(),
  routes: [
    { path: '/musicList', component: MusicList },
    { path: '/play/:id', component: MusicPlay },
    { path: '/', redirect: '/musicList' } // 默认重定向到音乐列表页面
  ]
});
 
// 创建 Vue 应用
const app = createApp(App);
 
// 使用 Pinia 和 Vue Router
app.use(pinia);
app.use(router);
 
// 挂载应用
app.mount('#app');

// main.ts
// import { createRouter, createWebHistory } from 'vue-router';
// import axios from 'axios';
// const { createApp, ref, onMounted } = Vue;

// createApp({
//   setup() {
//     const tasks = ref([]); // 用来存储任务列表
//     const loading = ref(true); // 用来表示加载状态

//     // 请求数据函数
//     const fetchTasks = async () => {
//       try {
//         const response = await axios.get('https://jsonplaceholder.typicode.com/todos');
//         tasks.value = response.data;
//       } catch (error) {
//         console.error('Error fetching tasks:', error);
//       } finally {
//         loading.value = false;
//       }
//     };

//     // 在组件挂载时请求数据
//     onMounted(fetchTasks);

//     return {
//       tasks,
//       loading
//     };
//   },
//   template: `
//     <div>
//       <h2>任务列表</h2>
//       <div v-if="loading">正在加载...</div>
//       <div v-else class="task-list">
//         <div v-for="task in tasks" :key="task.id" class="task-item" :class="task.completed ? 'completed' : 'not-completed'">
//           <p><strong>ID:</strong> {{ task.id }}</p>
//           <p><strong>任务标题:</strong> {{ task.title }}</p>
//           <p><strong>完成状态:</strong> {{ task.completed ? '已完成' : '未完成' }}</p>
//         </div>
//       </div>
//     </div>
//   `
// }).mount('#app');
