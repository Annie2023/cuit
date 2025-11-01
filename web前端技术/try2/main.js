// const { createApp, ref } = Vue;

// createApp({
//   setup() {
//     // 初始员工数据
//     const employees = ref([
//       { name: '张三', age: 30, position: '前端开发', isEditing: false },
//       { name: '李四', age: 25, position: '后端开发', isEditing: false }
//     ]);

//     // 添加员工
//     const addEmployee = () => {
//       const newEmployee = { name: '新员工', age: 0, position: '未指定', isEditing: false };
//       employees.value.push(newEmployee);
//     };

//     // 编辑员工
//     const editEmployee = (index) => {
//       employees.value[index].isEditing = true;
//     };

//     // 更新员工
//     const updateEmployee = (index) => {
//       employees.value[index].isEditing = false;
//     };

//     // 删除员工
//     const deleteEmployee = (index) => {
//       employees.value.splice(index, 1);
//     };

//     return {
//       employees,
//       addEmployee,
//       editEmployee,
//       updateEmployee,
//       deleteEmployee
//     };
//   }
// }).mount('#app');

//实验2.2
const { createApp, ref } = Vue;

createApp({
  setup() {
    // 初始员工数据
    const employees = ref([
      { name: '张三', age: 30, position: '前端开发', isEditing: false },
      { name: '李四', age: 25, position: '后端开发', isEditing: false }
    ]);

    // 添加员工
    const addEmployee = () => {
      const newEmployee = { name: '新员工', age: 0, position: '未指定', isEditing: false };
      employees.value.push(newEmployee);
    };

    // 编辑员工
    const editEmployee = (index) => {
      employees.value[index].isEditing = true;
    };

    // 更新员工
    const updateEmployee = (index) => {
      employees.value[index].isEditing = false;
    };

    // 删除员工
    const deleteEmployee = (index) => {
      employees.value.splice(index, 1);
    };

    // 隔行变色方法
    const getRowClass = (index) => {
      return index % 2 === 0 ? 'even-row' : 'odd-row';
    };

    return {
      employees,
      addEmployee,
      editEmployee,
      updateEmployee,
      deleteEmployee,
      getRowClass
    };
  }
}).mount('#app');
