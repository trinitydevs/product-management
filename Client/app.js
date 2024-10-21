new Vue({
    el: '#app',
    data: {
        action: '',
        modalTitle: 'Cadastrar produto',
        currentView: 'home',
        product: {
            id: '',
            name: '',
            description: '',
            price: '',
            stock: ''
        },
        products: [],
        logs: [],
        editModalVisible: false, 
        insertModalVisible: false 
    },
    methods: {
        showView(view) {
            this.currentView = view;

            switch (view) {
                case 'get':
                    this.selectAction('GET');
                    this.modalTitle = 'Listar produtos';
                    break;
                case 'post':
                    this.insertModalVisible = true;
                    this.modalTitle = 'Cadastrar produtos'; 
                    // this.selectAction('POST');
                    // this.createProduct();

                    break;
                case 'put':
                    this.insertModalVisible = true;
                    this.modalTitle = 'Atualizar produtos';
                    this.selectAction('PUT');
                    this.updateProduct();

                    break;
                case 'delete':
                    this.insertModalVisible = true;
                    this.modalTitle = 'Deletar produtos';
                    this.selectAction('DELETE');
                    this.deleteProduct();

                    break;
                case 'logs':
                    this.modalTitle = 'Auditoria';
                    this.selectAction('logs');

                    break;
            }
        },
        selectAction(action) {
            this.action = action;
            console.log('Current View:', this.currentView);
            console.log('Método: ', action);
        },
        async handleSubmit() {
            const url = 'http://localhost:8080/products';
            try {
                switch (url) {
                    case 'GET':
                        await this.getProducts();
                        break;
                    case 'POST':
                        await this.createProduct();
                        break;
                    case 'PUT':
                        await this.updateProduct();
                        break;
                    case 'DELETE':
                        await this.deleteProduct();
                        break;
                }
            } catch (error) {
                console.error('Erro ao processar a requisição:', error);
            }
        },
        async getProducts() {
            let url = 'http://localhost:8080/products';
            if (this.product.id) url += `/${this.product.id}`;

            const response = await fetch(url);
            this.products = await response.json();
        },
        async createProduct() {
            const response = await fetch('http://localhost:8080/products', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(this.product)
            });
            console.log(await response.json());
        },
        async updateProduct() {
            const response = await fetch(`http://localhost:8080/products/${this.product.id}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(this.product)
            });
            console.log(await response.json());
            console.log('Abrindo modal de edição para:', product);

            this.productToEdit = { ...product };
            setTimeout(() => {
                this.editModalVisible = true; 
            }, 100);
        },
        async deleteProduct() {
            const response = await fetch(`http://localhost:8080/products/${this.product.id}`, {
                method: 'DELETE',
                headers: { 'Content-Type': 'application/json' }
            });
            console.log(await response.json());
        },
        async fetchLogs() {
            const response = await fetch('http://localhost:8080/logs');
            this.logs = await response.json();
        },
        formatPrice(value) {
            return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(value);
        },
        formatDate(date) {
            return new Date(date).toLocaleString('pt-BR');
        }
    },
    mounted() {
        this.fetchLogs();
    },
    template: `
    <div id="app">
        <form @submit.prevent="handleSubmit">
        <header class="mb-4 mt-4">
            <h1 class="text-center">Gerenciador de Produtos</h1>
            <nav class="nav justify-content-center mb-4 mt-4">
                <button class="btn btn-outline-primary mx-2" @click="showView('post')">Cadastrar</button>
                <button class="btn btn-outline-primary mx-2" @click="showView('get')">Listar</button>
                <button class="btn btn-outline-primary mx-2" @click="showView('put')">Atualizar</button>
                <button class="btn btn-outline-primary mx-2" @click="showView('delete')">Excluir</button>
                <button class="btn btn-outline-primary mx-2" @click="showView('logs')">Auditoria</button>
            </nav>
        </header>

        <transition name="fade">
            <component :is="currentView"></component>
        </transition>

        <div v-if="insertModalVisible && (currentView === 'post' || currentView === 'put' || currentView === 'delete')" class="d-flex justify-content-center flex-column align-items-center">
            <h2 class="text-center">{{ modalTitle }}</h2>
            <button class="btn btn-secondary mb-3" @click="insertModalVisible = false">Voltar</button>
            <div id="produtosContainer" class="produtos-container">
                <div class="section">
                    <div class="form-group">
                        <label for="id">Id</label>
                        <input type="text" v-model="product.id" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" v-model="product.name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <input type="text" v-model="product.description" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="price">Preço</label>
                        <input type="text" v-model="product.price" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="stock">Estoque</label>
                        <input type="text" v-model="product.stock" class="form-control">
                    </div>
                    <button type="button" class="btn btn-primary" @click="createProduct">Inserir</button>
                </div>
            </div>
        </div>

        <div class="section" v-if="currentView === 'get'">
            <h2 class="text-center">{{ modalTitle }}</h2>
            <button class="btn btn-secondary mb-3" @click="insertModalVisible = false">Voltar</button>    
            <div class="form-group">
                <label for="id">Id</label>
                <input type="text" v-model="product.id" class="form-control">
            </div>
            <div class="table-center">
                <table id="tableProducts">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                            <th>Usuário</th>
                            <th>Data de execução</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in products" :key="product.idProduct">
                            <td>{{ product.idProduct }}</td>
                            <td>{{ product.nameProduct }}</td>
                            <td>{{ product.descProduct }}</td>
                            <td>{{ formatPrice(product.priceProduct) }}</td>
                            <td>{{ product.stockProduct }}</td>
                            <td>{{ product.userInsert }}</td>
                            <td>{{ formatDate(product.dateHour) }}</td>
                        </tr>
                    </tbody>
                </table>                
            </div>
        </div>

        <div class="section" v-if="currentView === 'logs'">
            <h2 class="text-center">{{ modalTitle }}</h2>
            <button class="btn btn-secondary mb-3" @click="insertModalVisible = false">Voltar</button>
            <div class="table-center">
                <table id="tableLogs">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Ação</th>
                            <th>Usuário</th>
                            <th>Produto</th>
                            <th>Data de execução</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="log in logs" :key="log.idLog">
                            <td>{{ log.idLog }}</td>
                            <td>{{ log.actionLog }}</td>
                            <td>{{ log.userInsert }}</td>
                            <td>{{ log.idProduct }}</td>
                            <td>{{ formatDate(log.dateHour) }}</td>
                        </tr>
                    </tbody>
                </table>            
            </div>
        </div>
        </form>
    </div>
    `
});
