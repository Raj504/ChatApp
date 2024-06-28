<template>
  <div class="container py-5">
    <div class="row">
      <div class="col-12">
        <div v-for="chatGroup in chatGroups" :key="chatGroup.id" class="card mb-4">
          <div class="card-header">
            <h3>{{ chatGroup.name }}</h3>
          </div>
          <div class="card-body chat-messages" style="max-height: 300px; overflow-y: auto;">
            <div v-for="message in chatGroup.messages" :key="message.id" class="mb-3">
              <strong>{{ message.user.name }}:</strong>
              <span v-if="!message.isEditing">{{ message.message }}</span>
              <input v-else v-model="message.message" @keyup.enter="updateMessage(chatGroup.id, message)" />
              <div v-if="message.user.id === user.id" class="float-right">
                <button @click="editMessage(message)" class="btn btn-sm btn-primary">Edit</button>
                <button @click="deleteMessage(chatGroup.id, message.id)" class="btn btn-sm btn-danger">Delete</button>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <input v-model="newMessage" @keyup.enter="sendMessage(chatGroup.id)" 
                   class="form-control" placeholder="Type a message...">
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['user', 'chatGroups'],
  data() {
    return {
      newMessage: ''
    };
  },
  methods: {
    sendMessage(chatGroupId) {
      if (this.newMessage.trim() === '') return;

      const message = {
        id: Date.now(), // Temporary ID
        user: this.user,
        message: this.newMessage,
        isEditing: false
      };

      const group = this.chatGroups.find(group => group.id === chatGroupId);
      if (group) {
        group.messages.push(message);
        this.newMessage = '';
        this.scrollToBottom(group.id);
      }

      axios.post('/chat/message', {
        chat_group_id: chatGroupId,
        message: message.message
      }).then(response => {
        // Optionally handle the response, e.g., updating the message ID if needed
      }).catch(error => {
        console.error('Message send failed:', error);
      });
    },
    editMessage(message) {
      message.isEditing = true;
    },
    updateMessage(chatGroupId, message) {
      axios.put(`/chat/message/${message.id}`, {
        message: message.message
      }).then(response => {
        message.isEditing = false;
      }).catch(error => {
        console.error('Message update failed:', error);
      });
    },
    deleteMessage(chatGroupId, messageId) {
      axios.delete(`/chat/message/${messageId}`).then(response => {
        const group = this.chatGroups.find(group => group.id === chatGroupId);
        if (group) {
          group.messages = group.messages.filter(message => message.id !== messageId);
        }
      }).catch(error => {
        console.error('Message delete failed:', error);
      });
    },
    scrollToBottom(chatGroupId) {
      this.$nextTick(() => {
        const chatMessages = this.$el.querySelector(`.chat-messages[data-group-id="${chatGroupId}"]`);
        if (chatMessages) {
          chatMessages.scrollTop = chatMessages.scrollHeight;
        }
      });
    }
  },
  mounted() {
    window.Echo.channel('chat')
      .listen('MessageSent', (e) => {
        const group = this.chatGroups.find(group => group.id === e.message.chat_group_id);
        if (group) {
          group.messages.push(e.message);
          this.scrollToBottom(group.id);
        }
      })
      .listen('MessageUpdated', (e) => {
        const group = this.chatGroups.find(group => group.id === e.message.chat_group_id);
        if (group) {
          const message = group.messages.find(message => message.id === e.message.id);
          if (message) {
            message.message = e.message.message;
            message.isEditing = false;
          }
        }
      })
      .listen('MessageDeleted', (e) => {
        const group = this.chatGroups.find(group => group.id === e.chat_group_id);
        if (group) {
          group.messages = group.messages.filter(message => message.id !== e.message_id);
        }
      });
  }
}
</script>

<style>
.chat-messages {
  background-color: #f8f9fa;
  padding: 1rem;
  border-radius: 5px;
}
</style>
