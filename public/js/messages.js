// Charger les messages au démarrage
document.addEventListener('DOMContentLoaded', function() {
  loadMessages();
  
  // Envoyer le formulaire en AJAX
  const messageForm = document.getElementById('messageForm');
  if (messageForm) {
    messageForm.addEventListener('submit', sendMessage);
  }
});

// Charger les messages via AJAX
async function loadMessages() {
  const currentUserId = document.querySelector('input[name="user_id"]').value;
  
  try {
    const response = await fetch(`/messages?user_id=${currentUserId}`, {
      method: 'GET',
      headers: {
        'Accept': 'application/json'
      }
    });

    if (response.ok) {
      const data = await response.json();
      displayMessages(data.messages);
      updateLastMessageStatus(data.lastMessage);
    } else {
      console.error('Erreur lors du chargement des messages');
    }
  } catch (error) {
    console.error('Erreur:', error);
  }
}

// Afficher les messages dans le DOM
function displayMessages(messages) {
  const messagesContainer = document.querySelector('.direct-chat-messages');
  if (!messagesContainer) return;

  const currentUserId = document.querySelector('input[name="user_id"]').value;
  let messagesHTML = '';

  if (messages.length === 0) {
    messagesHTML = '<p>Aucun message pour le moment.</p>';
  } else {
    messages.forEach(msg => {
      const isCurrentUser = (msg.user_id == currentUserId);
      const msgClass = isCurrentUser ? 'direct-chat-msg end' : 'direct-chat-msg';
      const nameFloat = isCurrentUser ? 'float-end' : 'float-start';
      const timeFloat = isCurrentUser ? 'float-start' : 'float-end';
      const avatar = isCurrentUser 
        ? 'dist/assets/img/user3-128x128.jpg'
        : 'dist/assets/img/user1-128x128.jpg';

      const dateCreated = new Date(msg.created_at);
      const dateFormatted = dateCreated.toLocaleDateString('fr-FR', {
        day: '2-digit',
        month: 'short',
        hour: '2-digit',
        minute: '2-digit'
      });

      messagesHTML += `
        <div class="${msgClass}">
          <div class="direct-chat-infos clearfix">
            <span class="direct-chat-name ${nameFloat}">
              ${msg.user_nom}
            </span>
            <span class="direct-chat-timestamp ${timeFloat}">
              ${dateFormatted}
            </span>
          </div>
          <img class="direct-chat-img" src="${avatar}" alt="user image">
          <div class="direct-chat-text">
            ${msg.content.replace(/\n/g, '<br>')}
          </div>
        </div>
      `;
    });
  }

  messagesContainer.innerHTML = messagesHTML;
  
  // Scroll vers le bas pour voir le dernier message
  messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

// Mettre à jour le statut du dernier message
function updateLastMessageStatus(lastMessage) {
  if (!lastMessage) return;

  let statusHTML = `
    <div class="mt-2 text-end small ${lastMessage.etat == 1 ? 'text-success' : 'text-danger'}">
      Dernier message : ${lastMessage.etat == 1 ? 'Lu' : 'Non lu'}
    </div>
  `;

  const messagesContainer = document.querySelector('.direct-chat-messages');
  if (messagesContainer) {
    messagesContainer.innerHTML += statusHTML;
  }
}

// Envoyer un message via AJAX
async function sendMessage(e) {
  e.preventDefault();

  const messageInput = document.getElementById('messageInput');
  const messageText = messageInput.value.trim();
  const userId = document.querySelector('input[name="user_id"]').value;
  const responseDiv = document.getElementById('messageResponse');

  if (!messageText) {
    showAlert(responseDiv, 'warning', 'Le message ne peut pas être vide');
    return;
  }

  try {
    const response = await fetch('/messages', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: new URLSearchParams({
        message: messageText,
        user_id: userId
      })
    });

    if (response.ok) {
      messageInput.value = '';
      showAlert(responseDiv, 'success', 'Message envoyé avec succès');
      
      // Recharger les messages
      setTimeout(() => {
        loadMessages();
      }, 500);
    } else {
      showAlert(responseDiv, 'danger', 'Erreur lors de l\'envoi du message');
    }
  } catch (error) {
    showAlert(responseDiv, 'danger', 'Erreur: ' + error.message);
    console.error('Erreur:', error);
  }
}

// Afficher une alerte
function showAlert(container, type, message) {
  container.innerHTML = `<div class="alert alert-${type} alert-dismissible fade show" role="alert">${message}</div>`;
  
  // Masquer l'alerte après 3 secondes
  setTimeout(() => {
    container.innerHTML = '';
  }, 3000);
}
