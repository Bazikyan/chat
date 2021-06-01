import React from 'react';

function Message({ message, user, friend }) {

    const sender = user.id === message.from_id ? user : friend;

    return (
        <li className="left clearfix">
            <div className="chat-body clearfix">
                <div className="header">
                    <strong className="primary-font">
                        { sender.name }
                    </strong>
                </div>
                <p>
                    { message.message }
                </p>
            </div>
        </li>
    );
}

export default Message;
