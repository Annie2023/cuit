// 定义构造函数
function Person(name, age) {
    this.name = name;
    this.age = age;
}

// 创建两个对象
const person1 = new Person('Alice', 25);
const person2 = new Person('Bob', 30);

// 将对象存储在数组中
const people = [person1, person2];

// 返回年龄最大的对象
function getOldestPerson(peopleArray) {
    return peopleArray.reduce((oldest, current) => {
        return current.age > oldest.age ? current : oldest;
    });
}

// 调用函数并输出结果
const oldestPerson = getOldestPerson(people);
console.log(`The oldest person is ${oldestPerson.name} with age ${oldestPerson.age}`);